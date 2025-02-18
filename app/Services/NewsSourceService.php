<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Contracts\NewsSourceRepositoryInterface;
use App\Http\Requests\NewsSourceDeleteRequest;
use App\Http\Requests\NewsSourceUpdateRequest;

class NewsSourceService extends BasicCrudService
{

    public function __construct(private NewsSourceRepositoryInterface $newsSourceRepository)
    { }

    /**
     * Handle the update request.
     *
     * @param  \App\Http\Requests\NewsSourceUpdateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleUpdate(NewsSourceUpdateRequest $request): ResponseData
    {
        return $this->update($request, $this->newsSourceRepository);
    }

    /**
     * Handle the delete request.
     *
     * @param  \App\Http\Requests\NewsSourceDeleteRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleDelete(NewsSourceDeleteRequest $request): ResponseData
    {
        return $this->delete($request, $this->newsSourceRepository);
    }

    /**
     * Handle the read request.
     *
     * @param null|string|int $id
     * @return array
     */
    public function handleRead(null|string|int $id = null): ResponseData
    {
        return $this->read($this->newsSourceRepository, 'news_source', $id);
    }

}
