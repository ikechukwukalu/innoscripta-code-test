<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryService extends BasicCrudService
{

    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    { }

    /**
     * Handle the create request.
     *
     * @param  \App\Http\Requests\CategoryCreateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleCreate(CategoryCreateRequest $request): ResponseData
    {
        return $this->create($request, $this->categoryRepository);
    }

    /**
     * Handle the update request.
     *
     * @param  \App\Http\Requests\CategoryUpdateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleUpdate(CategoryUpdateRequest $request): ResponseData
    {
        return $this->update($request, $this->categoryRepository);
    }

    /**
     * Handle the delete request.
     *
     * @param  \App\Http\Requests\CategoryDeleteRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleDelete(CategoryDeleteRequest $request): ResponseData
    {
        return $this->delete($request, $this->categoryRepository);
    }

    /**
     * Handle the read request.
     *
     * @param null|string|int $id
     * @return array
     */
    public function handleRead(null|string|int $id = null): ResponseData
    {
        return $this->read($this->categoryRepository, 'category', $id);
    }

}
