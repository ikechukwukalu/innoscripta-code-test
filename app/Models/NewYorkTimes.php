<?php

namespace App\Models;

use App\Models\Scopes\NewYorkTimesScope;
use App\Services\NewYorkTimesService;
use App\Traits\DefaultOrderTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewYorkTimes extends NewsSource
{
    use DefaultOrderTrait, SoftDeletes;

    //
    protected $table = 'news_sources';

    protected static function booted(): void
    {
        static::addGlobalScope(new NewYorkTimesScope);
    }

    public function getNewsService(): mixed
    {
        return new NewYorkTimesService;
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => NewYorkTimes::class,
        );
    }
}
