<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * @group No Auth APIs
 *
 * APIs that do not require User authentication
 */

/**
 * @group Auth APIs
 *
 * APIs that require User authentication
 */

/**
 * @group Web URLs
 *
 * APIs that do not require User authentication and is performed over a web browser
 *
 * @subgroup Socialite APIs
 * @subgroup TwoFactor APIs
 */


Route::middleware('auth:sanctum')->group(function () {
    require __DIR__.'/app/user.php';
    require __DIR__.'/app/admin.php';
});

require __DIR__.'/app/public.php';
