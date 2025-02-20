<?php

namespace App\Models;

use App\Models\Scopes\TheGuardianScope;
use App\Services\TheGuardianService;
use App\Traits\DefaultOrderTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheGuardian extends NewsSource
{
    use DefaultOrderTrait, SoftDeletes;

    protected $table = 'news_sources';

    protected static function booted(): void
    {
        static::addGlobalScope(new TheGuardianScope);
    }

    public function getNewsService(): mixed
    {
        return new TheGuardianService;
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => TheGuardian::class,
        );
    }
}
