<?php

namespace App\Models;

use App\Models\Scopes\NewYorkTimesScope;
use App\Traits\DefaultOrderTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class NewYorkTimes extends NewsSource
{
    use DefaultOrderTrait;

    //
    protected $table = 'news_sources';

    protected static function booted(): void
    {
        static::addGlobalScope(new NewYorkTimesScope);
    }

    public function getNewsService(): mixed
    {
        return null;
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => NewYorkTimes::class,
        );
    }
}
