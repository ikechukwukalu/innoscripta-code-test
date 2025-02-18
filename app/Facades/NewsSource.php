<?php

namespace App\Facades;

use App\Contracts\NewsSourceRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class NewsSource extends Facade
{

    protected static function getFacadeAccessor()
    {
        return NewsSourceRepositoryInterface::class;
    }
}
