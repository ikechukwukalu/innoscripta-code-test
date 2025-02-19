<?php

namespace App\Contracts;

use App\Models\NewsSource;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsSourceRepositoryInterface
{

    /**
     * Fetch all \App\Models\NewsSource records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection;

    /**
     * Fetch \App\Models\NewsSource record by ID.
     *
     * @param int|string $id
     * @return \App\Models\NewsSource|null
     */
    public function getById(int|string $id): null|NewsSource;

    /**
     * Delete \App\Models\NewsSource record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void;

    /**
     * Create \App\Models\NewsSource record.
     *
     * @param array $arrayDetails
     * @return \App\Models\NewsSource
     */
    public function create(array $arrayDetails): NewsSource;

    /**
     * Fetch or create a single \App\Models\NewsSource record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsSource
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): NewsSource;

    /**
     * Update \App\Models\NewsSource record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int;

    /**
     * Update \App\Models\NewsSource record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator;

    /**
     * Fetch \App\Models\NewsSource record by Model.
     *
     * @param string $model
     * @return \App\Models\NewsSource|null
     */
    public function getByModel(string $model): null|NewsSource;

    /**
     * Insert multiple \App\Models\NewsSource records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool;
}
