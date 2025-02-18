<?php

namespace App\Facades;

use App\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Category extends Facade
{

    protected static function getFacadeAccessor()
    {
        return CategoryRepositoryInterface::class;
    }
}
