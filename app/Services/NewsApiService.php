<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Facades\Author as AuthorFacade;
use App\Facades\Category as CategoryFacade;
use App\Facades\NewsSource as NewsSourceFacade;
use App\Models\NewsApi;
use Illuminate\Http\Response;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

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

            if (!$newsApi = NewsSourceFacade::getByModel(NewsApi::class)) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.news_source_not_found', ['name' => 'NewsApi']));
            }

            if (!$categories = CategoryFacade::getAll()) {
                return responseData(false, Response::HTTP_EXPECTATION_FAILED, trans('general.category_not_found'));
            }

            $responses = Http::pool(function (Pool $pool) use($newsApi, $categories) : array {
                $url = env('NEWS_API_URL') . '/top-headlines';
                $apiKey = env('NEWS_API_KEY');
                $pools = [];

                foreach ($categories as $category) {
                    $pools[] = $pool->as($category->id)->get($url, [
                        'from' => date('Y-m-d', strtotime('-1 month')),
                        'sortBy' => 'publishedAt',
                        'pageSize' => 10,
                        'apiKey' => $apiKey,
                        'category' => $category->name,
                    ]);
                }

                return $pools;
            });

            $data = [];

            foreach ($responses as $categoryId => $response) {
                if ($response->ok()) {
                    $resp = $response->json();
                    $articles = $resp['articles'];
                    $category = CategoryFacade::getById($categoryId);

                    if ($articles) {
                        $tempAry = collect($articles)->map(function ($article) use($category, $newsApi) {

                            if (!NewsSourceFacade::getBySourceExternalId($article['source']['id'])) {
                                $this->newsArticleInserts[] = [
                                    'title' => $article['title'],
                                    'description' => $article['description'],
                                    'content' => $article['content'],
                                    'published_at' => $article['publishedAt'],
                                    'news_source_id' => $newsApi->id,
                                    'category_id' => $category->id,
                                    'news_source_name' => $newsApi->name,
                                    'category_name' => $category->name,
                                    'source_external_id' => $article['source']['id'],
                                    'imageUrl' => $article['urlToImage'],
                                    'active' => true,
                                ];
                            }

                            $authors = explode(',', $article['author']);

                            foreach ($authors as $author) {
                                if (!AuthorFacade::getByUniqueId($author)) {
                                    $this->authorInserts[] = [
                                        'name' => $author,
                                        'twitter' => null,
                                        'website' => null,
                                        'imageUrl' => null,
                                    ];
                                }
                            }

                            return $article;

                        })->toArray();

                        $data = array_merge_recursive($data, $tempAry);
                    }

                }
            }

            $message = trans('general.success');
            $index = $categories[0]->id;

            if ($responses[$index]->ok() == false) {
                $message = trans('general.fail');
            }

            $this->saveArticles();
            $this->saveAuthors();

            return responseData($responses[$index]->ok(), $responses[$index]->getStatusCode(), $message, $data);
        }, function (\Throwable $th) {

            return responseData(false, Response::HTTP_EXPECTATION_FAILED, $th->getMessage(), $th->getTrace());
        });
    }
}
