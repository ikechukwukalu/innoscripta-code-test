<?php

namespace App\Repositories;

use App\Contracts\UserPreferenceRepositoryInterface;
use App\Models\UserPreference;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserPreferenceRepository implements UserPreferenceRepositoryInterface
{

    /**
     * Fetch all \App\Models\UserPreference records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return UserPreference::all();
    }

    /**
     * Fetch \App\Models\UserPreference record by ID.
     *
     * @param int|string $id
     * @return \App\Models\UserPreference|null
     */
    public function getById(int|string $id): null|UserPreference
    {
        return UserPreference::find($id);
    }

    /**
     * Delete \App\Models\UserPreference record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        UserPreference::destroy($id);
    }

    /**
     * Create \App\Models\UserPreference record.
     *
     * @param array $arrayDetails
     * @return \App\Models\UserPreference
     */
    public function create(array $arrayDetails): UserPreference
    {
        return UserPreference::create($arrayDetails);
    }

    /**
     * Fetch or create a single \App\Models\UserPreference record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\UserPreference
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): UserPreference
    {
        return UserPreference::firstOrCreate($matchDetails, $arrayDetails);
    }

    /**
     * Update \App\Models\UserPreference record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int
    {
        return UserPreference::where('id', $id)->update($arrayDetails);
    }

    /**
     * Update \App\Models\UserPreference record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator
    {
        return UserPreference::paginate($pageSize);
    }

    public function getByUserIdPaginated(int $userId, int $pageSize): LengthAwarePaginator
    {
        return UserPreference::where('user_id', $userId)->paginate($pageSize);
    }

    /**
     * Fetch all \App\Models\PartnerDriver records by user id.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId(int $userId): EloquentCollection
    {
        return UserPreference::where('user_id', $userId)->get();
    }

    /**
     * Fetch \App\Models\Consolidation record by ID.
     *
     * @param int $userId
     * @param int $id
     * @return \App\Models\UserPreference|null
     */
    public function getByUserIdAndId(int $userId, int $id): null|UserPreference
    {
        return UserPreference::where('user_id', $userId)->where('id', $id)->first();
    }
}
