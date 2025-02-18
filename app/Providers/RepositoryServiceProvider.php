<?php

namespace App\Providers;

use App\Contracts\AdminRepositoryInterface;
use App\Contracts\AuthorRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ContactUsRepositoryInterface;
use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\DBRepositoryInterface;
use App\Contracts\NewsArticleRepositoryInterface;
use App\Contracts\NewsSourceRepositoryInterface;
use App\Contracts\OldPasswordRepositoryInterface;
use App\Contracts\SocialiteLoginRepositoryInterface;
use App\Contracts\TwoFactorLoginRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserDeviceTokenRepositoryInterface;
use App\Contracts\UserPasswordHolderRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ContactUsRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\DBRepository;
use App\Repositories\NewsArticleRepository;
use App\Repositories\NewsSourceRepository;
use App\Repositories\OldPasswordRepository;
use App\Repositories\SocialiteLoginRepository;
use App\Repositories\TwoFactorLoginRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserDeviceTokenRepository;
use App\Repositories\UserPasswordHolderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(DBRepositoryInterface::class, DBRepository::class);
        $this->app->bind(OldPasswordRepositoryInterface::class, OldPasswordRepository::class);
        $this->app->bind(SocialiteLoginRepositoryInterface::class, SocialiteLoginRepository::class);
        $this->app->bind(TwoFactorLoginRepositoryInterface::class, TwoFactorLoginRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserDeviceTokenRepositoryInterface::class, UserDeviceTokenRepository::class);
        $this->app->bind(UserPasswordHolderRepositoryInterface::class, UserPasswordHolderRepository::class);
        $this->app->bind(NewsSourceRepositoryInterface::class, NewsSourceRepository::class);
        $this->app->bind(NewsArticleRepositoryInterface::class, NewsArticleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
