<?php

namespace App\Facades;

use App\Contracts\NewsAuthorRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class NewsAuthor extends Facade
{

    protected static function getFacadeAccessor()
    {
        return NewsAuthorRepositoryInterface::class;
    }
}
