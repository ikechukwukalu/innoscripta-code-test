<?php

namespace App\Repositories;

use App\Contracts\NewsArticleRepositoryInterface;
use App\Enums\UserPreferenceType;
use App\Facades\UserPreference as UserPreferenceFacade;
use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsArticleRepository implements NewsArticleRepositoryInterface
{
    private array $whiteList = ['news_source_id', 'category_id', 'published_at', 'archived_at'];

    /**
     * Fetch all \App\Models\NewsArticle records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): EloquentCollection
    {
        return $this->filterOptions()->get();
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
        return $this->filterOptions()->paginate(pageSize($pageSize));
    }

    /**
     * Insert multiple \App\Models\NewsArticle records.
     *
     * @param array $arrayDetails
     * @return bool
     */
    public function insert(array $arrayDetails): bool
    {
        return NewsArticle::insert($arrayDetails);
    }

    /**
     * Fetch \App\Models\NewsArticle record by Model.
     *
     * @param string $sourceExternalId
     * @return \App\Models\NewsArticle|null
     */
    public function getBySourceExternalId(string $sourceExternalId): null|NewsArticle
    {
        return NewsArticle::where('source_external_id', $sourceExternalId)->first();
    }

    public function getByUserIdPaginated(string|int $userId, int $pageSize): LengthAwarePaginator
    {
        return $this->preferenceOptions($userId, 'paginate');
    }

    /**
     * Fetch all \App\Models\PartnerDriver records by user id.
     *
     * @param string|int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId(string|int $userId): EloquentCollection
    {
        return $this->preferenceOptions($userId, 'all');
    }

    /**
     * Fetch \App\Models\Consolidation record by ID.
     *
     * @param string|int $userId
     * @param int $id
     * @return \App\Models\NewsArticle|null
     */
    public function getByUserIdAndId(string|int $userId, int $id): null|NewsArticle
    {
        return NewsArticle::where('id', $id)->first();
    }

    /**
     * Summary of filterOptions
     * @return mixed
     */
    private function filterOptions(): mixed
    {
        return NewsArticle::with(['newsSource', 'category'])
                    ->search(['title', 'description', 'content', 'authors', 'news_source_name', 'category_name'])
                    ->order()
                    ->date()
                    ->filter($this->whiteList);
    }

    private function preferenceOptions(int|string $userId, string $type = 'all'): mixed
    {
        if (!$userPreferences = UserPreferenceFacade::getByUserId($userId)->keyBy('type')) {

            if ($type == 'all') {
                return NewsArticle::all();
            }

            return NewsArticle::paginate();

        }

        $ary = $userPreferences->toArray();
        $builder = NewsArticle::query();

        if (array_key_exists(UserPreferenceType::SOURCE->value, $ary))
        {
            $builder->where(function(Builder $query) use($userPreferences) {
                $query->orWhereIn('news_source_name', $userPreferences[UserPreferenceType::SOURCE->value]->pluck('tag')->toArray());
            });
        }

        if (array_key_exists(UserPreferenceType::CATEGORY->value, $ary))
        {
            $builder->where(function(Builder $query) use($userPreferences) {
                $query->orWhereIn('category_name', $userPreferences[UserPreferenceType::CATEGORY->value]->pluck('tag')->toArray());
            });
        }

        if (array_key_exists(UserPreferenceType::AUTHOR->value, $ary))
        {
            $builder->where(function(Builder $query) use($userPreferences) {
                $authors = $userPreferences[UserPreferenceType::AUTHOR->value]->pluck('tag')->toArray();

                foreach ($authors as $author) {
                    $query->orWhere('authors', 'LIKE', "%{$author}%");
                }

            });
        }

        if ($type == 'all') {
            return $builder->get();
        }

        return $builder->paginate();
    }
}
