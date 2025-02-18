<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Auth\RequestGuard;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Auth::customer() for web
        SessionGuard::macro('customer', function(int|string|null $id = null): Customer|null {
            return Customer::find($id ?? Auth::user()->id)->first();
        });

        //Auth::customer() for api
        RequestGuard::macro('customer', function(int|string|null $id = null): Customer|null {
            return Customer::find($id ?? Auth::user()->id)->first();
        });

        //Auth::admin() for web
        SessionGuard::macro('admin', function(int|string|null $id = null): Admin|null {
            return Admin::find($id ?? Auth::user()->id)->first();
        });

        //Auth::admin() for api
        RequestGuard::macro('admin', function(int|string|null $id = null): Admin|null {
            return Admin::find($id ?? Auth::user()->id)->first();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
