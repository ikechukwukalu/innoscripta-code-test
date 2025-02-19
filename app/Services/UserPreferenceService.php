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
        $validated['user_id'] = $user->id;

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
     * @param string | int $userId
     * @param null|string|int $id
     * @return ResponseData
     */
    public function handleReadByUserId(string | int $userId, null | string | int $id = null): ResponseData
    {
        return $this->readByUserId($this->userPreferenceRepository, 'user_preference', $userId, $id);
    }

}
