<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Facades\NewsArticle as NewsArticleFacade;

abstract class NewsOutletService
{

    protected array $newsArticleInserts = [];
    protected array $authorInserts = [];
    protected array $newsAuthorInserts = [];

    abstract public function authorization(): array;
    abstract public function fetchArticles(): ResponseData;

    /**
     * Summary of saveArticle
     * @return bool
     */
    protected function saveArticles(): bool
    {
        return NewsArticleFacade::insert($this->newsArticleInserts);
    }
}
