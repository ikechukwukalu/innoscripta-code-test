<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsSourceDeleteRequest;
use App\Http\Requests\NewsSourceReadRequest;
use App\Http\Requests\NewsSourceUpdateRequest;
use App\Services\NewsSourceService;
use Illuminate\Http\JsonResponse;

class NewsSourceController extends Controller
{

    public function __construct(private NewsSourceService $newsSourceService)
    { }

    /**
     * Update NewsSource.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the NewsSource. Example: 1
     * @bodyParam name string required The name for the NewsSource. Example: John
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
     * @subgroup NewsSource APIs
     * @group Auth APIs
     */
    public function update(NewsSourceUpdateRequest $request): JsonResponse
    {
        return $this->_update($request, $this->newsSourceService);
    }

    /**
     * Delete NewsSource.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the NewsSource. Example: 1
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
     * @subgroup NewsSource APIs
     * @group Auth APIs
     */
    public function delete(NewsSourceDeleteRequest $request): JsonResponse
    {
        return $this->_delete($request, $this->newsSourceService);
    }

    /**
     * Read NewsSource.
     *
     * Fetch a record or records from the NewsSources table.
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
     * @subgroup NewsSource APIs
     * @group Auth APIs
     */
    public function read(NewsSourceReadRequest $request, null|string|int $id = null): JsonResponse
    {
        return $this->_read($request, $this->newsSourceService, $id);
    }

}
