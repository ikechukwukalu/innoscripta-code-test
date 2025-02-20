<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Models\NewYorkTimes;

class NewYorkTimesService extends NewsOutletService
{

    public function fetchArticles(): ResponseData
    {
        $newSourceModel = NewYorkTimes::class;
        $url = env('NEW_YORK_TIMES_URL') . '/articlesearch.json';
        $apiKey = env('NEW_YORK_TIMES_API_KEY');
        $queryParams = [
            'begin_date' => date('Ymd', strtotime('-1 month')),
            'end_date' => date('Ymd', time()),
            'sort' => 'newest',
            'page' => 10,
            'api-key' => $apiKey,
        ];
        $queryParamCategoryKey = 'fq';
        $articlesKey = 'response.docs';
        $newsArticleInsertKeys = [
            'title' => 'abstract',
            'description' => 'snippet',
            'content' => 'web_url',
            'published_at' => 'pub_date',
            'source_external_id' => '_id',
            'imageUrl' => null,
            'contentIsUrl' => true,
            'active' => true,
            'authors' => 'byline.original',
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
