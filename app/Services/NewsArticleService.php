<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Contracts\NewsArticleRepositoryInterface;
use App\Http\Requests\NewsArticleDeleteRequest;
use App\Http\Requests\NewsArticleUpdateRequest;

class NewsArticleService extends BasicCrudService
{

    public function __construct(private NewsArticleRepositoryInterface $newsArticleRepository)
    { }

    /**
     * Handle the update request.
     *
     * @param  \App\Http\Requests\NewsArticleUpdateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleUpdate(NewsArticleUpdateRequest $request): ResponseData
    {
        return $this->update($request, $this->newsArticleRepository);
    }

    /**
     * Handle the delete request.
     *
     * @param  \App\Http\Requests\NewsArticleDeleteRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleDelete(NewsArticleDeleteRequest $request): ResponseData
    {
        return $this->delete($request, $this->newsArticleRepository);
    }

    /**
     * Handle the read request.
     *
     * @param null|string|int $id
     * @return array
     */
    public function handleRead(null|string|int $id = null): ResponseData
    {
        return $this->read($this->newsArticleRepository, 'news_article', $id);
    }

}
