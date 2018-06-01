<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('categories', 'App\Repositories\CategoryRepository');
        $this->app->singleton('currencies', 'App\Repositories\CurrencyRepository');
        $this->app->singleton('languages', 'App\Repositories\LanguageRepository');
        $this->app->singleton('price-types', 'App\Repositories\PriceTypeRepository');
    }
}
