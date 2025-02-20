<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Facades\Category as CategoryFacade;
use App\Facades\NewsArticle as NewsArticleFacade;
use App\Facades\NewsSource as NewsSourceFacade;
use App\Models\NewYorkTimes;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

abstract class NewsOutletService
{

    protected array $newsArticleInserts = [];
    protected array $authorInserts = [];
    protected array $newsAuthorInserts = [];

    abstract public function fetchArticles(): ResponseData;

    /**
     * Summary of saveArticle
     * @return bool
     */
    protected function saveArticles(): bool
    {
        return NewsArticleFacade::insert($this->newsArticleInserts);
    }

    protected function fetchArticlesBuilder(
        string $newSourceModel,
        string $url,
        string $apiKey,
        array $queryParams,
        string $queryParamCategoryKey,
        string $articlesKey,
        array $newsArticleInsertKeys,
    ): ResponseData
    {
        return tryCatch(function ()
            use(
                $newSourceModel,
                $url,
                $apiKey,
                $queryParams,
                $queryParamCategoryKey,
                $articlesKey,
                $newsArticleInsertKeys)
        {

            if (!$newSource = NewsSourceFacade::getByModel($newSourceModel)) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.news_source_not_found', ['name' => 'NewsApi']));
            }

            if (!$categories = CategoryFacade::getAll()) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.category_not_found'));
            }

            $responses = Http::pool(function (Pool $pool)
                use(
                    $newSource,
                    $categories,
                    $url,
                    $apiKey,
                    $queryParams,
                    $queryParamCategoryKey,
                    $articlesKey,
                    $newsArticleInsertKeys) : array
            {
                $pools = [];

                foreach ($categories as $category) {
                    $queryParams[$queryParamCategoryKey] = strtolower($category->name);

                    if ($newSource == NewYorkTimes::class) {
                        $queryParams[$queryParamCategoryKey] = "news_desk:(" . strtolower($category->name) . ")";
                    }

                    $pools[] = $pool->as($category->id)->get($url, $queryParams);
                }

                return $pools;
            });

            foreach ($responses as $categoryId => $response) {

                if ($response->ok()) {

                    $resp = $response->json();
                    $articles = data_get($resp, $articlesKey);
                    $category = $categories->where('id', $categoryId)->first();

                    if ($articles) {
                        collect($articles)->map(function ($article)
                            use(
                                $category,
                                $newSource,
                                $newsArticleInsertKeys)
                            {

                            if (data_get($article, $newsArticleInsertKeys['source_external_id'])
                                && !NewsArticleFacade::getBySourceExternalId(data_get($article, $newsArticleInsertKeys['source_external_id']))) {
                                $this->newsArticleInserts[] = [
                                    'title' => data_get($article, $newsArticleInsertKeys['title']),
                                    'description' => data_get($article, $newsArticleInsertKeys['description']),
                                    'content' => data_get($article, $newsArticleInsertKeys['content']),
                                    'published_at' => Carbon::parse(data_get($article, $newsArticleInsertKeys['published_at'])),
                                    'news_source_id' => $newSource->id,
                                    'category_id' => $category->id,
                                    'news_source_name' => $newSource->name,
                                    'category_name' => $category->name,
                                    'source_external_id' => data_get($article, $newsArticleInsertKeys['source_external_id']),
                                    'imageUrl' => $newsArticleInsertKeys['imageUrl'] ? data_get($article, $newsArticleInsertKeys['imageUrl']) : null,
                                    'contentIsUrl' => $newsArticleInsertKeys['contentIsUrl'],
                                    'active' => true,
                                    'authors' => $newsArticleInsertKeys['authors'] ? data_get($article, $newsArticleInsertKeys['authors']) : null,
                                ];
                            }

                            return $article;

                        })->toArray();

                    }

                }

            }

            $message = trans('general.success');
            $index = $categories[0]->id;

            if ($responses[$index]->ok() == false) {
                $message = trans('general.fail');
            }

            $this->saveArticles();

            return responseData($responses[$index]->ok(), $responses[$index]->getStatusCode(), $message, $this->newsArticleInserts);
        }, function (\Throwable $th) {

            return responseData(false, Response::HTTP_EXPECTATION_FAILED, $th->getMessage(), $th->getTrace());
        });
    }
}
