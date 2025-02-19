<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Facades\Author as AuthorFacade;
use App\Facades\NewsArticle as NewsArticleFacade;
use App\Facades\NewsAuthor as NewsAuthorFacade;

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

    /**
     * Summary of saveAuthor
     * @return bool
     */
    protected function saveAuthors(): bool
    {
        return AuthorFacade::insert($this->authorInserts);
    }

    protected function saveNewsAuthors(): bool
    {
        return NewsAuthorFacade::insert($this->newsAuthorInserts);
    }
}
