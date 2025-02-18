<?php

namespace App\Providers;

use App\Services\Auth\ThrottleRequestsService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ThrottleRequestsService::class, function (Application $app) {
            return new ThrottleRequestsService(
                config('api.login.maxAttempts', 3),
                config('api.login.delayMinutes', 1)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
