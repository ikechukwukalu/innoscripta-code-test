<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceCreateRequest;
use App\Http\Requests\UserPreferenceDeleteRequest;
use App\Http\Requests\UserPreferenceReadRequest;
use App\Services\UserPreferenceService;
use Illuminate\Http\JsonResponse;

class UserPreferenceController extends Controller
{

    public function __construct(private UserPreferenceService $userPreferenceService)
    { }

    /**
     * Create UserPreference.
     *
     * @header Authorization Bearer {Your key}
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
     * @subgroup UserPreference APIs
     * @group Auth APIs
     */
    public function create(UserPreferenceCreateRequest $request): JsonResponse
    {
        return $this->_create($request, $this->userPreferenceService);
    }

    /**
     * Delete UserPreference.
     *
     * @header Authorization Bearer {Your key}
     *
     * @bodyParam id string required The id of the UserPreference. Example: 1
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
     * @subgroup UserPreference APIs
     * @group Auth APIs
     */
    public function delete(UserPreferenceDeleteRequest $request): JsonResponse
    {
        return $this->_delete($request, $this->userPreferenceService);
    }

    /**
     * Read UserPreference.
     *
     * Fetch a record or records from the UserPreferences table.
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
     * @subgroup UserPreference APIs
     * @group Auth APIs
     */
    public function read(UserPreferenceReadRequest $request, null|string|int $id = null): JsonResponse
    {
        return $this->_read($request, $this->userPreferenceService, $id);
    }

    /**
     * Read UserPreference by UserID.
     *
     * Fetch a record or records from the Payouts table.
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
     * @subgroup UserPreference APIs
     * @group Auth APIs
     */
    public function readByUserId(UserPreferenceReadRequest $request, string|int $userId, null|string|int $id = null): JsonResponse
    {
        return $this->_readByUserId($this->userPreferenceService, $userId,$id);
    }

}
