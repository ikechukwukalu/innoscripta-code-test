<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Contracts\AuthorRepositoryInterface;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorDeleteRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorService extends BasicCrudService
{

    public function __construct(private AuthorRepositoryInterface $authorRepository)
    { }

    /**
     * Handle the create request.
     *
     * @param  \App\Http\Requests\AuthorCreateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleCreate(AuthorCreateRequest $request): ResponseData
    {
        return $this->create($request, $this->authorRepository);
    }

    /**
     * Handle the update request.
     *
     * @param  \App\Http\Requests\AuthorUpdateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleUpdate(AuthorUpdateRequest $request): ResponseData
    {
        return $this->update($request, $this->authorRepository);
    }

    /**
     * Handle the delete request.
     *
     * @param  \App\Http\Requests\AuthorDeleteRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleDelete(AuthorDeleteRequest $request): ResponseData
    {
        return $this->delete($request, $this->authorRepository);
    }

    /**
     * Handle the read request.
     *
     * @param null|string|int $id
     * @return array
     */
    public function handleRead(null|string|int $id = null): ResponseData
    {
        return $this->read($this->authorRepository, 'author', $id);
    }

}
