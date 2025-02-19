<?php

namespace App\Enums;

use App\Models\Author;
use App\Models\Category;
use App\Models\NewsApi;
use App\Models\NewYorkTimes;
use App\Models\TheGuardian;

enum UserPreferenceType: string
{
    case SOURCE = 'source';
    case AUTHOR = 'author';
    case CATEGORY = 'category';


    public static function toArray(): array
    {
        return [
            static::SOURCE->value,
            static::AUTHOR->value,
            static::CATEGORY->value,
        ];
    }

}
