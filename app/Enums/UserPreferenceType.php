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

    case NEWS_API = 'news_api';
    CASE NEW_YORK_TIMES = 'new_york_times';
    CASE THE_GUARDIAN = 'the_guardian';

    public static function toArray(): array
    {
        return [
            static::SOURCE->value,
            static::AUTHOR->value,
            static::CATEGORY->value,
        ];
    }

    public static function sourcesToArray(): array
    {
        return [
            static::NEWS_API->value,
            static::NEW_YORK_TIMES->value,
            static::THE_GUARDIAN->value,
        ];
    }

    public static function getTypeModel(string $type, string|null $typeOfSource = null): string|null
    {
        $types = [
            static::SOURCE->value => [
                static::NEWS_API->value => NewsApi::class,
                static::NEW_YORK_TIMES->value => NewYorkTimes::class,
                static::THE_GUARDIAN->value => TheGuardian::class
            ],
            static::AUTHOR->value => Author::class,
            static::CATEGORY->value => Category::class,
        ];

        if (!array_key_exists($type, $types)) {
            return null;
        }

        if ($type == static::SOURCE->value) {
            if (is_null($typeOfSource)) {
                return null;
            }

            if (!array_key_exists($typeOfSource, $types[static::SOURCE->value])) {
                return null;
            }

            return $types[static::SOURCE->value][$typeOfSource];
        }

        return $types[$type];
    }

}
