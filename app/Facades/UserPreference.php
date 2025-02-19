<?php

namespace App\Facades;

use App\Contracts\UserPreferenceRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class UserPreference extends Facade
{

    protected static function getFacadeAccessor()
    {
        return UserPreferenceRepositoryInterface::class;
    }
}
