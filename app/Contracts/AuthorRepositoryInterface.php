<?php

namespace App\Contracts;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{

    /**
     * Fetch all \App\Models\Author records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection;

    /**
     * Fetch \App\Models\Author record by ID.
     *
     * @param int|string $id
     * @return \App\Models\Author|null
     */
    public function getById(int|string $id): null|Author;

    /**
     * Delete \App\Models\Author record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void;

    /**
     * Create \App\Models\Author record.
     *
     * @param array $arrayDetails
     * @return \App\Models\Author
     */
    public function create(array $arrayDetails): Author;

    /**
     * Fetch or create a single \App\Models\Author record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\Author
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): Author;

    /**
     * Update \App\Models\Author record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int;

    /**
     * Update \App\Models\Author record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator;

    /**
     * Insert multiple \App\Models\Author records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool;

    /**
     * Fetch \App\Models\Author record by Model.
     *
     * @param string $uniqueId
     * @return \App\Models\Author|null
     */
    public function getByUniqueId(string $uniqueId): null|Author;

    /**
     * Fetch \App\Models\Author record by batchNo.
     *
     * @param string $batchNo
     * @return EloquentCollection
     */
    public function getByBatchNo(string $batchNo): EloquentCollection;
}
