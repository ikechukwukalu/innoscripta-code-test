<?php

namespace App\Facades;

use App\Contracts\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Author extends Facade
{

    protected static function getFacadeAccessor()
    {
        return AuthorRepositoryInterface::class;
    }
}
