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

    protected $configs = [
        'tables', 'repositories'
    ];

    /**
     * List of only Local Environment Facade Aliases
     * @var array
     */
    protected $facadeAliases = [
        'Attributes' => 'MosseboShopCore\Support\Facades\Attributes',
        'Categories' => 'MosseboShopCore\Support\Facades\Categories',
        'Rooms'      => 'MosseboShopCore\Support\Facades\Rooms',
        'Styles'     => 'MosseboShopCore\Support\Facades\Styles',
        'Currencies' => 'MosseboShopCore\Support\Facades\Currencies',
        'Languages'  => 'MosseboShopCore\Support\Facades\Languages',
        'PriceTypes' => 'MosseboShopCore\Support\Facades\PriceTypes',
    ];

    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        $this->registerServiceProviders();
        $this->registerFacadeAliases();
        $this->publishConfigs();
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        $this->registerConfigs();
    }

    /**
     * Load local service providers
     */
    protected function registerServiceProviders()
    {
        foreach ($this->localProviders as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load additional Aliases
     */
    public function registerFacadeAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->facadeAliases as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }

    protected function publishConfigs()
    {
        foreach ($this->configs as $key => $configFileName) {
            $this->publishes([
                $this->getConfigPath($configFileName) => $this->getConfigPublishPath($configFileName)
             ], $configFileName);
        }
    }

    protected function registerConfigs()
    {
        foreach ($this->configs as $key => $configFileName) {
            $this->mergeConfigFrom($this->getConfigPath($configFileName), $configFileName);
        }
    }

    protected function getConfigPath($configFileName)
    {
        return __DIR__ . "/Config/{$configFileName}.php";
    }

    protected function getConfigPublishPath($configFileName)
    {
        return function_exists('config_path') ?
            config_path("{$configFileName}.php") :
            base_path("config/{$configFileName}.php");
    }
}