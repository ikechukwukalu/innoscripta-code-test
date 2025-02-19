<?php

namespace App\Contracts;

use App\Models\NewsAuthor;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsAuthorRepositoryInterface
{

    /**
     * Fetch all \App\Models\NewsAuthor records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection;

    /**
     * Fetch \App\Models\NewsAuthor record by ID.
     *
     * @param int|string $id
     * @return \App\Models\NewsAuthor|null
     */
    public function getById(int|string $id): null|NewsAuthor;

    /**
     * Delete \App\Models\NewsAuthor record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void;

    /**
     * Create \App\Models\NewsAuthor record.
     *
     * @param array $arrayDetails
     * @return \App\Models\NewsAuthor
     */
    public function create(array $arrayDetails): NewsAuthor;

    /**
     * Fetch or create a single \App\Models\NewsAuthor record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsAuthor
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): NewsAuthor;

    /**
     * Update \App\Models\NewsAuthor record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int;

    /**
     * Update or create a single \App\Models\NewsAuthor record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsAuthor
     */
    public function updateOrCreate(array $matchDetails, array $arrayDetails): NewsAuthor;

    /**
     * Fetch \App\Models\NewsAuthor paginated record.
     *
     * @param int $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int $pageSize): LengthAwarePaginator;

    /**
     * Fetch \App\Models\NewsAuthor record by ID and user ID.
     *
     * @param int|string $id
     * @param int|string $userId
     * @return \App\Models\NewsAuthor|null
     */
    public function getByIdAndUserId(int|string $id, int|string $userId): null|NewsAuthor;

    /**
     * Fetch \App\Models\NewsAuthor record by user ID.
     *
     * @param int|string $userId
     * @param bool $first
     * @return \App\Models\NewsAuthor|null|\Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId(int|string $userId, bool $first = false): null|NewsAuthor|EloquentCollection;

    /**
     * Fetch \App\Models\NewsAuthor paginated record by user ID.
     *
     * @param int $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedByUserId(int $pageSize, int|string $userId): LengthAwarePaginator;

    /**
     * Insert multiple \App\Models\NewsAuthor records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool;
}
