<?php

namespace App\Facades;

use App\Contracts\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Article extends Facade
{

    protected static function getFacadeAccessor()
    {
        return ArticleRepositoryInterface::class;
    }
}
