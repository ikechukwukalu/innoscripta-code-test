<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryReadRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function __construct(private CategoryService $categoryService)
    { }

    /**
     * Create Category.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam name string required The name of the Category. Example: John
     *
     * @response 200
     *
     * {
     * "success": true,
     * "status_code": 200,
     * "message": string
     * "data": {}
     * }
     *
     * @authenticated
     * @subgroup Category APIs
     * @group Auth APIs
     */
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        return $this->_create($request, $this->categoryService);
    }

    /**
     * Update Category.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the Category. Example: 1
     * @bodyParam name string required The name for the Category. Example: John
     *
     * @response 200
     *
     * {
     * "success": true,
     * "status_code": 200,
     * "message": string
     * "data": {}
     * }
     *
     * @authenticated
     * @subgroup Category APIs
     * @group Auth APIs
     */
    public function update(CategoryUpdateRequest $request): JsonResponse
    {
        return $this->_update($request, $this->categoryService);
    }

    /**
     * Delete Category.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the Category. Example: 1
     *
     * @response 200
     *
     * {
     * "success": true,
     * "status_code": 200,
     * "message": string
     * "data": {}
     * }
     *
     * @authenticated
     * @subgroup Category APIs
     * @group Auth APIs
     */
    public function delete(CategoryDeleteRequest $request): JsonResponse
    {
        return $this->_delete($request, $this->categoryService);
    }

    /**
     * Read Category.
     *
     * Fetch a record or records from the Categorys table.
     * The <b>id</b> param is optional but can either be a <b>string|null|int</b>
     *
     * If the <b>id</b> has a <b>null</b> value the records will be paginated.
     * The returned page size is be set from <b>api.paginate.user_address.pageSize</b>
     * config.
     *
     * If the <b>id</b> is a <b>string</b> value it can only be set as <b>'all'</b>.
     * This will return all the records without being paginated.
     *
     * If the <b>id</b> value is an <b>integer</b> it will try to fetch a single
     * matching record.
     *
     * @header Authorization Bearer {Your key}
     *
     * @urlParam id string The ID of the record. Example: all
     *
     * @response 200
     *
     * {
     * "success": true,
     * "status_code": 200,
     * "message": string
     * "data": {}
     * }
     *
     * @authenticated
     * @subgroup Category APIs
     * @group Auth APIs
     */
    public function read(CategoryReadRequest $request, null|string|int $id = null): JsonResponse
    {
        return $this->_read($request, $this->categoryService, $id);
    }

}
