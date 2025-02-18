<?php

namespace App\Services;

use App\Actions\ResponseData;
use App\Contracts\UserPreferenceRepositoryInterface;
use App\Enums\UserPreferenceType;
use App\Http\Requests\UserPreferenceCreateRequest;
use App\Http\Requests\UserPreferenceDeleteRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserPreferenceService extends BasicCrudService
{

    public function __construct(private UserPreferenceRepositoryInterface $userPreferenceRepository)
    { }

    /**
     * Handle the create request.
     *
     * @param  \App\Http\Requests\UserPreferenceCreateRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleCreate(UserPreferenceCreateRequest $request): ResponseData
    {
        $user = Auth::user();
        $validated = $request->validated();
        $sourceType = null;

        if (empty($validated)) {
            return responseData(false, Response::HTTP_BAD_REQUEST, trans('general.empty_payload'));
        }

        if (isset($validated['source_type'])) {
            $sourceType = $validated['source_type'];

            unset($validated['source_type']);
        }

        $validated['user_id'] = $user->id;
        $validated['preferential_type'] = UserPreferenceType::getTypeModel($validated['type'], $sourceType);

        return $this->create($validated, $this->userPreferenceRepository);
    }

    /**
     * Handle the delete request.
     *
     * @param  \App\Http\Requests\UserPreferenceDeleteRequest $request
     * @return \App\Actions\ResponseData
     */
    public function handleDelete(UserPreferenceDeleteRequest $request): ResponseData
    {
        return $this->delete($request, $this->userPreferenceRepository);
    }

    /**
     * Handle the read request.
     *
     * @param null|string|int $id
     * @return array
     */
    public function handleRead(null|string|int $id = null): ResponseData
    {
        return $this->read($this->userPreferenceRepository, 'user_preference', $id);
    }

    /**
     * Handle the read request.
     *
     * @param int $userId
     * @param null|string|int $id
     * @return ResponseData
     */
    public function handleReadByUserId(int $userId, null | string | int $id = null): ResponseData
    {
        return $this->readByUserId($this->userPreferenceRepository, 'user_preference', $userId, $id);
    }

}
