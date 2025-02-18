<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * Fetch all \App\Models\Category records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return Category::all();
    }

    /**
     * Fetch \App\Models\Category record by ID.
     *
     * @param int|string $id
     * @return \App\Models\Category|null
     */
    public function getById(int|string $id): null|Category
    {
        return Category::find($id);
    }

    /**
     * Delete \App\Models\Category record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        Category::destroy($id);
    }

    /**
     * Create \App\Models\Category record.
     *
     * @param array $arrayDetails
     * @return \App\Models\Category
     */
    public function create(array $arrayDetails): Category
    {
        return Category::create($arrayDetails);
    }

    /**
     * Fetch or create a single \App\Models\Category record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\Category
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): Category
    {
        return Category::firstOrCreate($matchDetails, $arrayDetails);
    }

    /**
     * Update \App\Models\Category record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int
    {
        return Category::where('id', $id)->update($arrayDetails);
    }

    /**
     * Update \App\Models\Category record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator
    {
        return Category::paginate($pageSize);
    }
}
