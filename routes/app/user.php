<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\ContactUsController;
use App\Http\Controllers\Auth\UserDeviceTokenController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\NewsArticleController;
use App\Http\Controllers\NewsSourceController;
use App\Http\Controllers\UserPreferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

    Route::post('resend/verify/email', [VerificationController::class, 'resendUserEmailVerification'])->name('verification.resend');
    Route::post('resend/verify/phone', [VerificationController::class, 'resendUserPhoneVerification'])->name('verification.resend.phone');

    Route::middleware(['check.email.verification'])->group(function () {

        Route::post('change/password', [ChangePasswordController::class, 'changePassword'])->name('changePassword');
        Route::post('edit/profile', [ProfileController::class, 'editProfile'])->name('editProfile');
        Route::post('create-two-factor', [TwoFactorController::class, 'createTwoFactor'])->name('createTwoFactor');
        Route::post('confirm-two-factor', [TwoFactorController::class, 'confirmTwoFactor'])->name('confirmTwoFactor');
        Route::post('disable-two-factor', [TwoFactorController::class, 'disableTwoFactor'])->name('disableTwoFactor');
        Route::post('current-recovery-codes', [TwoFactorController::class, 'currentRecoveryCodes'])->name('currentRecoveryCodes');
        Route::post('new-recovery-codes', [TwoFactorController::class, 'newRecoveryCodes'])->name('newRecoveryCodes');
        Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
        Route::post('logout-from-all-sessions', [LogoutController::class, 'logoutFromAllSessions'])->name('logoutFromAllSessions');
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::prefix('device_token')->group(function () {
            Route::post('create', [UserDeviceTokenController::class, 'create'])->name('createUserDeviceToken');
            Route::delete('delete', [UserDeviceTokenController::class, 'delete'])->name('deleteUserDeviceToken');
            Route::get('read/{id?}', [UserDeviceTokenController::class, 'read'])->name('readUserDeviceToken');
            Route::put('update', [UserDeviceTokenController::class, 'update'])->name('updateUserDeviceToken');
        });

        Route::prefix('contact_us')->group(function () {
            Route::delete('delete', [ContactUsController::class, 'delete'])->name('deleteContactUs');
            Route::get('read/{id?}', [ContactUsController::class, 'read'])->name('readContactUs');
            Route::put('update', [ContactUsController::class, 'update'])->name('updateContactUs');
        });

    });

    Route::prefix('news')->group(function () {

        Route::prefix('article')->group(function () {

            Route::get('read/{id?}', [NewsArticleController::class, 'read'])->name('readNewsArticle');
            Route::get('user_read/{user_id}/{id?}', [NewsArticleController::class, 'readByUserId'])->name('readByUserIdNewsArticle');

        });

        Route::prefix('source')->group(function () {

            Route::get('read/{id?}', [NewsSourceController::class, 'read'])->name('readNewsSource');

        });

    });

    Route::prefix('preference')->group(function () {

        Route::post('create', [UserPreferenceController::class, 'create'])->name('createUserPreference');
        Route::delete('delete', [UserPreferenceController::class, 'delete'])->name('deleteUserPreference');
        Route::get('user_read/{user_id}/{id?}', [UserPreferenceController::class, 'readByUserId'])->name('readByUserIdUserPreference');

    });

});
