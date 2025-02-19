<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Facades\Author as AuthorFacade;
use App\Facades\Category as CategoryFacade;
use App\Facades\NewsArticle as NewsArticleFacade;
use App\Facades\NewsSource as NewsSourceFacade;
use App\Models\NewsApi;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsApiService extends NewsOutletService
{

    /**
     * Summary of authorization
     * @return array{apiKey: string}
     */
    public function authorization(): array
    {
        return [
            'Authorization' => env('NEWS_API_KEY'),
        ];
    }

    public function fetchArticles(): ResponseData
    {
        return tryCatch(function () {

            if (!$newSource = NewsSourceFacade::getByModel(NewsApi::class)) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.news_source_not_found', ['name' => 'NewsApi']));
            }

            if (!$categories = CategoryFacade::getAll()) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.category_not_found'));
            }

            $responses = Http::pool(function (Pool $pool) use($newSource, $categories) : array {
                $url = env('NEWS_API_URL') . '/top-headlines';
                $apiKey = env('NEWS_API_KEY');
                $pools = [];

                foreach ($categories as $category) {
                    $pools[] = $pool->as($category->id)->get($url, [
                        'from' => date('Y-m-d', strtotime('-1 month')),
                        'sortBy' => 'publishedAt',
                        'pageSize' => 10,
                        'apiKey' => $apiKey,
                        'category' => strtolower($category->name),
                    ]);
                }

                return $pools;
            });

            $batchNo = sha1(time() . Str::random(40));

            foreach ($responses as $categoryId => $response) {

                if ($response->ok()) {

                    $resp = $response->json();
                    $articles = data_get($resp, 'articles');
                    $category = $categories->where('id', $categoryId)->first();

                    if ($articles) {
                        collect($articles)->map(function ($article) use($category, $newSource, $batchNo) {

                            if (!NewsArticleFacade::getBySourceExternalId($article['source']['id'])) {
                                $this->newsArticleInserts[] = [
                                    'title' => $article['title'],
                                    'description' => $article['description'],
                                    'content' => $article['content'],
                                    'published_at' => Carbon::parse($article['publishedAt']),
                                    'news_source_id' => $newSource->id,
                                    'category_id' => $category->id,
                                    'news_source_name' => $newSource->name,
                                    'category_name' => $category->name,
                                    'source_external_id' => $article['source']['id'],
                                    'imageUrl' => $article['urlToImage'],
                                    'contentIsUrl' => false,
                                    'active' => true,
                                ];
                            }

                            if (isset($article['author'])) {
                                $authors = explode(',', $article['author']);

                                foreach ($authors as $author) {
                                    if (!AuthorFacade::getByUniqueId($author)) {
                                        $this->authorInserts[] = [
                                            'name' => $author,
                                            'twitter' => null,
                                            'website' => null,
                                            'imageUrl' => null,
                                            'batch_no' => $batchNo,
                                        ];
                                    }
                                }
                            }

                            return $article;

                        })->toArray();
                    }

                }

            }

            $authorIds = AuthorFacade::getByBatchNo($batchNo)->pluck('id')->toArray();

            foreach ($authorIds as $authorId) {
                $this->newsArticleInserts[] = [
                    'author_id' => $authorId,
                    'news_source_id' => $newSource->id,
                ];
            }

            $message = trans('general.success');
            $index = $categories[0]->id;

            if ($responses[$index]->ok() == false) {
                $message = trans('general.fail');
            }

            $this->saveArticles();
            $this->saveAuthors();
            $this->saveNewsAuthors();

            return responseData($responses[$index]->ok(), $responses[$index]->getStatusCode(), $message, $this->newsArticleInserts);
        }, function (\Throwable $th) {

            return responseData(false, Response::HTTP_EXPECTATION_FAILED, $th->getMessage(), $th->getTrace());
        });
    }
}
