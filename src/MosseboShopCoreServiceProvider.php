<?php

namespace MosseboShopCore;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class MosseboShopCoreServiceProvider extends ServiceProvider {

    /**
     * List of Local Environment Providers
     * @var array
     */
    protected $localProviders = [
        'MosseboShopCore\Providers\RepoServiceProvider'
    ];

    /**
     * List of only Local Environment Facade Aliases
     * @var array
     */
    protected $facadeAliases = [
        'Categories' => 'MosseboShopCore\Support\Facades\Categories',
        'Currencies' => 'MosseboShopCore\Support\Facades\Currencies',
        'Languages'  => 'MosseboShopCore\Support\Facades\Languages',
        'PriceTypes' => 'MosseboShopCore\Support\Facades\PriceTypes',
    ];

    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot() {
        if ($this->app->isLocal()) {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register() {
    }

    /**
     * Load local service providers
     */
    protected function registerServiceProviders() {
        foreach ($this->localProviders as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load additional Aliases
     */
    public function registerFacadeAliases() {
        $loader = AliasLoader::getInstance();
        foreach ($this->facadeAliases as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }
}