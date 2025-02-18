<?php

namespace App\Models;

use App\Models\Scopes\NewsApiScope;
use App\Traits\DefaultOrderTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsApi extends NewsSource
{
    use DefaultOrderTrait, SoftDeletes;

    //
    protected $table = 'news_sources';

    protected static function booted(): void
    {
        static::addGlobalScope(new NewsApiScope);
    }

    public function getNewsService(): mixed
    {
        return null;
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => NewsApi::class,
        );
    }
}
