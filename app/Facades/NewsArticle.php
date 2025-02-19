<?php

namespace App\Facades;

use App\Contracts\NewsArticleRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class NewsArticle extends Facade
{

    protected static function getFacadeAccessor()
    {
        return NewsArticleRepositoryInterface::class;
    }
}
