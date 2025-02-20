<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Models\TheGuardian;

class TheGuardianService extends NewsOutletService
{

    public function fetchArticles(): ResponseData
    {
        $newSourceModel = TheGuardian::class;
        $url = env('THE_GUARDIAN_URL') . '/search';
        $apiKey = env('THE_GUARDIAN_API_KEY');
        $queryParams = [
            'from-date' => date('Y-m-d', strtotime('-1 month')),
            'to-date' => date('Y-m-d', time()),
            'orderBy' => 'newest',
            'pageSize' => 10,
            'api-key' => $apiKey,
        ];
        $queryParamCategoryKey = 'section';
        $articlesKey = 'response.results';
        $newsArticleInsertKeys = [
            'title' => 'webTitle',
            'description' => 'sectionName',
            'content' => 'webUrl',
            'published_at' => 'webPublicationDate',
            'source_external_id' => 'id',
            'imageUrl' => null,
            'contentIsUrl' => true,
            'active' => true,
            'authors' => null,
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
