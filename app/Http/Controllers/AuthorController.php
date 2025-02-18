<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorDeleteRequest;
use App\Http\Requests\AuthorReadRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{

    public function __construct(private AuthorService $authorService)
    { }

    /**
     * Create Author.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam name string required The name of the Author. Example: John
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
     * @subgroup Author APIs
     * @group Auth APIs
     */
    public function create(AuthorCreateRequest $request): JsonResponse
    {
        return $this->_create($request, $this->authorService);
    }

    /**
     * Update Author.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the Author. Example: 1
     * @bodyParam name string required The name for the Author. Example: John
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
     * @subgroup Author APIs
     * @group Auth APIs
     */
    public function update(AuthorUpdateRequest $request): JsonResponse
    {
        return $this->_update($request, $this->authorService);
    }

    /**
     * Delete Author.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the Author. Example: 1
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
     * @subgroup Author APIs
     * @group Auth APIs
     */
    public function delete(AuthorDeleteRequest $request): JsonResponse
    {
        return $this->_delete($request, $this->authorService);
    }

    /**
     * Read Author.
     *
     * Fetch a record or records from the Authors table.
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
     * @subgroup Author APIs
     * @group Auth APIs
     */
    public function read(AuthorReadRequest $request, null|string|int $id = null): JsonResponse
    {
        return $this->_read($request, $this->authorService, $id);
    }

}
