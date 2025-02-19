<?php

namespace App\Services;

use App\Actions\ArticleData;
use App\Actions\AuthorData;
use App\Actions\ResponseData;
use App\Facades\Article as ArticleFacade;
use App\Facades\Author as AuthorFacade;
use App\Facades\NewsArticle as NewsArticleFacade;
use Illuminate\Http\Response;

abstract class NewsOutletService
{

    protected array $newsArticleInserts = [];

    protected array $authorInserts = [];

    abstract public function authorization(): array;

    abstract public function fetchArticles(): ResponseData;

    /**
     * Summary of saveArticle
     * @return array|object|ResponseData|null
     */
    protected function saveArticles(): ResponseData
    {
        if (!NewsArticleFacade::insert($this->newsArticleInserts)) {
            return responseData(false, Response::HTTP_BAD_REQUEST, trans('general.fail'));
        }

        return responseData(true, Response::HTTP_OK, trans('general.success'));
    }

    /**
     * Summary of saveAuthor
     * @return array|object|ResponseData|null
     */
    protected function saveAuthors(): ResponseData
    {
        if (!AuthorFacade::insert($this->authorInserts)) {
            return responseData(false, Response::HTTP_BAD_REQUEST, trans('general.fail'));
        }

        return responseData(true, Response::HTTP_OK, trans('general.success'));
    }
}
