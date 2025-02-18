<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsArticleDeleteRequest;
use App\Http\Requests\NewsArticleReadRequest;
use App\Http\Requests\NewsArticleUpdateRequest;
use App\Services\NewsArticleService;
use Illuminate\Http\JsonResponse;

class NewsArticleController extends Controller
{

    public function __construct(private NewsArticleService $newsArticleService)
    { }

    /**
     * Update NewsArticle.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the NewsArticle. Example: 1
     * @bodyParam name string required The name for the NewsArticle. Example: John
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
     * @subgroup NewsArticle APIs
     * @group Auth APIs
     */
    public function update(NewsArticleUpdateRequest $request): JsonResponse
    {
        return $this->_update($request, $this->newsArticleService);
    }

    /**
     * Delete NewsArticle.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the NewsArticle. Example: 1
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
     * @subgroup NewsArticle APIs
     * @group Auth APIs
     */
    public function delete(NewsArticleDeleteRequest $request): JsonResponse
    {
        return $this->_delete($request, $this->newsArticleService);
    }

    /**
     * Read NewsArticle.
     *
     * Fetch a record or records from the NewsArticles table.
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
     * @subgroup NewsArticle APIs
     * @group Auth APIs
     */
    public function read(NewsArticleReadRequest $request, null|string|int $id = null): JsonResponse
    {
        return $this->_read($request, $this->newsArticleService, $id);
    }

}
