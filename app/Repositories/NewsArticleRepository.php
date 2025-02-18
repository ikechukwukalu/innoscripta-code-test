<?php

namespace App\Repositories;

use App\Contracts\NewsArticleRepositoryInterface;
use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsArticleRepository implements NewsArticleRepositoryInterface
{

    /**
     * Fetch all \App\Models\NewsArticle records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return NewsArticle::all();
    }

    /**
     * Fetch \App\Models\NewsArticle record by ID.
     *
     * @param int|string $id
     * @return \App\Models\NewsArticle|null
     */
    public function getById(int|string $id): null|NewsArticle
    {
        return NewsArticle::find($id);
    }

    /**
     * Delete \App\Models\NewsArticle record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        NewsArticle::destroy($id);
    }

    /**
     * Create \App\Models\NewsArticle record.
     *
     * @param array $arrayDetails
     * @return \App\Models\NewsArticle
     */
    public function create(array $arrayDetails): NewsArticle
    {
        return NewsArticle::create($arrayDetails);
    }

    /**
     * Fetch or create a single \App\Models\NewsArticle record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsArticle
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): NewsArticle
    {
        return NewsArticle::firstOrCreate($matchDetails, $arrayDetails);
    }

    /**
     * Update \App\Models\NewsArticle record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int
    {
        return NewsArticle::where('id', $id)->update($arrayDetails);
    }

    /**
     * Update \App\Models\NewsArticle record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator
    {
        return NewsArticle::paginate($pageSize);
    }
}
