<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsArticleController;
use App\Http\Controllers\NewsSourceController;
use App\Http\Controllers\UserPreferenceController;
use Illuminate\Support\Facades\Route;

Route::prefix('user/admin')->middleware(['check.user.is.admin'])->group(function () {

    Route::prefix('news')->group(function () {

        Route::prefix('article')->group(function () {

            Route::delete('delete', [NewsArticleController::class, 'delete'])->name('deleteNewsArticle');
            Route::put('update', [NewsArticleController::class, 'update'])->name('updateNewsArticle');

        });

        Route::prefix('source')->group(function () {

            Route::delete('delete', [NewsSourceController::class, 'delete'])->name('deleteNewsSource');
            Route::put('update', [NewsSourceController::class, 'update'])->name('updateNewsSource');

        });

        Route::prefix('category')->group(function () {

            Route::post('create', [CategoryController::class, 'create'])->name('createCategory');
            Route::delete('delete', [CategoryController::class, 'delete'])->name('deleteCategory');
            Route::put('update', [CategoryController::class, 'update'])->name('updateCategory');

        });

    });
    Route::prefix('preference')->group(function () {

        Route::get('read/{id?}', [UserPreferenceController::class, 'read'])->name('readUserPreference');

    });

});
