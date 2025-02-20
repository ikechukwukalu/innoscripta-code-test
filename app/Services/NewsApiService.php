<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Models\NewsApi;

class NewsApiService extends NewsOutletService
{

    /**
     * Summary of authorization
     * @return array{apiKey: string}
     */
    public function fetchArticles(): ResponseData
    {
        $newSourceModel = NewsApi::class;
        $url = env('NEWS_API_URL') . '/top-headlines';
        $apiKey = env('NEWS_API_KEY');
        $queryParams = [
            'from' => date('Y-m-d', strtotime('-1 month')),
            'sortBy' => 'publishedAt',
            'pageSize' => 10,
            'apiKey' => $apiKey,
        ];
        $queryParamCategoryKey = 'category';
        $articlesKey = 'articles';
        $newsArticleInsertKeys = [
            'title' => 'title',
            'description' => 'description',
            'content' => 'content',
            'published_at' => 'publishedAt',
            'source_external_id' => 'source.id',
            'imageUrl' => 'urlToImage',
            'contentIsUrl' => false,
            'active' => true,
            'authors' => 'author',
        ];

        return $this->fetchArticlesBuilder(
            $newSourceModel,
            $url,
            $apiKey,
            $queryParams,
            $queryParamCategoryKey,
            $articlesKey,
            $newsArticleInsertKeys
        );

    }
}
