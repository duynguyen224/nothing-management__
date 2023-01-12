<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Users
        $this->app->singleton(
            \App\Repositories\Interface\IUserRepository::class,
            \App\Repositories\Implement\UserRepository::class,
        );
        $this->app->singleton(
            \App\Services\Interface\IAuthService::class,
            \App\Services\Implement\AuthService::class,
        );

        // Products
        $this->app->singleton(
            \App\Repositories\Interface\IProductRepository::class,
            \App\Repositories\Implement\ProductRepository::class,
        );
        $this->app->singleton(
            \App\Services\Interface\IProductService::class,
            \App\Services\Implement\ProductService::class,
        );

        // Categories
        $this->app->singleton(
            \App\Repositories\Interface\ICategoryRepository::class,
            \App\Repositories\Implement\CategoryRepository::class,
        );
        $this->app->singleton(
            \App\Services\Interface\ICategoryService::class,
            \App\Services\Implement\CategoryService::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
