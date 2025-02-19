<?php

namespace App\Repositories;

use App\Contracts\NewsSourceRepositoryInterface;
use App\Models\NewsSource;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsSourceRepository implements NewsSourceRepositoryInterface
{

    /**
     * Fetch all \App\Models\NewsSource records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return NewsSource::all();
    }

    /**
     * Fetch \App\Models\NewsSource record by ID.
     *
     * @param int|string $id
     * @return \App\Models\NewsSource|null
     */
    public function getById(int|string $id): null|NewsSource
    {
        return NewsSource::find($id);
    }

    /**
     * Delete \App\Models\NewsSource record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        NewsSource::destroy($id);
    }

    /**
     * Create \App\Models\NewsSource record.
     *
     * @param array $arrayDetails
     * @return \App\Models\NewsSource
     */
    public function create(array $arrayDetails): NewsSource
    {
        return NewsSource::create($arrayDetails);
    }

    /**
     * Fetch or create a single \App\Models\NewsSource record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\NewsSource
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): NewsSource
    {
        return NewsSource::firstOrCreate($matchDetails, $arrayDetails);
    }

    /**
     * Update \App\Models\NewsSource record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int
    {
        return NewsSource::where('id', $id)->update($arrayDetails);
    }

    /**
     * Update \App\Models\NewsSource record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator
    {
        return NewsSource::paginate($pageSize);
    }

    /**
     * Fetch \App\Models\NewsSource record by Model.
     *
     * @param string $model
     * @return \App\Models\NewsSource|null
     */
    public function getByModel(string $model): null|NewsSource
    {
        return NewsSource::where('model', $model)->first();
    }

    /**
     * Fetch \App\Models\NewsSource record by Model.
     *
     * @param string $sourceExternalId
     * @return \App\Models\NewsSource|null
     */
    public function getBySourceExternalId(string $sourceExternalId): null|NewsSource
    {
        return NewsSource::where('source_external_id', $sourceExternalId)->first();
    }

    /**
     * Insert multiple \App\Models\NewsSource records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool
    {
        return NewsSource::insert($arrayDetails);
    }
}
