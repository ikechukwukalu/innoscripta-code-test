<?php

namespace App\Models;

use App\Models\Scopes\TheGuardianScope;
use App\Traits\DefaultOrderTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TheGuardian extends NewsSource
{
    use DefaultOrderTrait;

    //
    protected $table = 'news_sources';

    protected static function booted(): void
    {
        static::addGlobalScope(new TheGuardianScope);
    }

    public function getNewsService(): mixed
    {
        return null;
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => TheGuardian::class,
        );
    }
}
