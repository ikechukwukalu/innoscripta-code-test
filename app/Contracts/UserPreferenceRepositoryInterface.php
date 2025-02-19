<?php

namespace App\Contracts;

use App\Models\UserPreference;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserPreferenceRepositoryInterface
{

    /**
     * Fetch all \App\Models\UserPreference records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection;

    /**
     * Fetch \App\Models\UserPreference record by ID.
     *
     * @param int|string $id
     * @return \App\Models\UserPreference|null
     */
    public function getById(int|string $id): null|UserPreference;

    /**
     * Delete \App\Models\UserPreference record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void;

    /**
     * Create \App\Models\UserPreference record.
     *
     * @param array $arrayDetails
     * @return \App\Models\UserPreference
     */
    public function create(array $arrayDetails): UserPreference;

    /**
     * Fetch or create a single \App\Models\UserPreference record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\UserPreference
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): UserPreference;

    /**
     * Update \App\Models\UserPreference record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int;

    /**
     * Update \App\Models\UserPreference record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator;

    /**
     * Update \App\Models\UserPreference  record.
     *
     * @param string|int $userId
     * @param int $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByUserIdPaginated(string|int $userId, int $pageSize): LengthAwarePaginator;

    /**
     * Fetch all \App\Models\UserPreference  records by user id.
     *
     * @param string|int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId(string|int $userId): EloquentCollection;

    /**
     * Fetch \App\Models\UserPreference record by ID.
     *
     * @param string|int $userId
     * @param int $id
     * @return \App\Models\UserPreference|null
     */
    public function getByUserIdAndId(string|int $userId, int $id): null|UserPreference;
}
