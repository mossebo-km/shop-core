<?php

namespace MosseboShopCore\Providers;

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
        $this->app->singleton('attributes', 'MosseboShopCore\Repositories\AttributeRepository');
        $this->app->singleton('categories', 'MosseboShopCore\Repositories\CategoryRepository');
        $this->app->singleton('rooms', 'MosseboShopCore\Repositories\RoomRepository');
        $this->app->singleton('styles', 'MosseboShopCore\Repositories\StyleRepository');
        $this->app->singleton('currencies', 'MosseboShopCore\Repositories\CurrencyRepository');
        $this->app->singleton('languages', 'MosseboShopCore\Repositories\LanguageRepository');
        $this->app->singleton('price-types', 'MosseboShopCore\Repositories\PriceTypeRepository');
    }
}
