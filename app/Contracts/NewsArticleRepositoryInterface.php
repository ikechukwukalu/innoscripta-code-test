<?php

namespace App\Contracts;

use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsArticleRepositoryInterface
{

    /**
     * Fetch all \App\Models\NewsArticle records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection;

    /**
     * Fetch \App\Models\NewsArticle record by ID.
     *
     * @param int|string $id
     * @return \App\Models\NewsArticle|null
     */
    public function getById(int|string $id): null|NewsArticle;

    /**
     * Delete \App\Models\NewsArticle record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void;

    /**
     * Create \App\Models\NewsArticle record.
     *
     * @param array $arrayDetails
     * @return \App\Models\NewsArticle
     */
    public function create(array $arrayDetails): NewsArticle;

    /**
     * Fetch or create a single \App\Models\NewsArticle record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsArticle
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): NewsArticle;

    /**
     * Update \App\Models\NewsArticle record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int;

    /**
     * Update \App\Models\NewsArticle record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator;

    /**
     * Insert multiple \App\Models\NewsArticle records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool;

    /**
     * Fetch \App\Models\NewsArticle record by Model.
     *
     * @param string $sourceExternalId
     * @return \App\Models\NewsArticle|null
     */
    public function getBySourceExternalId(string $sourceExternalId): null|NewsArticle;
}
