<?php

namespace App\Repositories;

use App\Contracts\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorRepository implements AuthorRepositoryInterface
{

    /**
     * Fetch all \App\Models\Author records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return Author::all();
    }

    /**
     * Fetch \App\Models\Author record by ID.
     *
     * @param int|string $id
     * @return \App\Models\Author|null
     */
    public function getById(int|string $id): null|Author
    {
        return Author::find($id);
    }

    /**
     * Delete \App\Models\Author record by ID.
     *
     * @param int|string $id
     * @return void
     */
    public function delete(int|string $id): void
    {
        Author::destroy($id);
    }

    /**
     * Create \App\Models\Author record.
     *
     * @param array $arrayDetails
     * @return \App\Models\Author
     */
    public function create(array $arrayDetails): Author
    {
        return Author::create($arrayDetails);
    }

    /**
     * Fetch or create a single \App\Models\Author record.
     *
     * @param array $matchDetails
     * @param array $arrayDetails
     * @return \App\Models\Author
     */
    public function firstOrCreate(array $matchDetails, array $arrayDetails): Author
    {
        return Author::firstOrCreate($matchDetails, $arrayDetails);
    }

    /**
     * Update \App\Models\Author record.
     *
     * @param int|string $id
     * @param array $arrayDetails
     * @return int
     */
    public function update(int|string $id, array $arrayDetails): int
    {
        return Author::where('id', $id)->update($arrayDetails);
    }

    /**
     * Update \App\Models\Author record.
     *
     * @param int|string $pageSize
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int|string $pageSize): LengthAwarePaginator
    {
        return Author::paginate($pageSize);
    }
}
