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

    ];

    protected $configs = [
        'tables', 'repositories', 'shop/promo', 'shop/price', 'shop/badges', 'shop/repositories'
    ];

    /**
     * List of only Local Environment Facade Aliases
     * @var array
     */
    protected $facadeAliases = [
        'Shop'          => 'MosseboShopCore\Support\Facades\Shop',
        'Attributes'    => 'MosseboShopCore\Support\Facades\Attributes',
        'Categories'    => 'MosseboShopCore\Support\Facades\Categories',
        'Rooms'         => 'MosseboShopCore\Support\Facades\Rooms',
        'Styles'        => 'MosseboShopCore\Support\Facades\Styles',
        'Currencies'    => 'MosseboShopCore\Support\Facades\Currencies',
        'DeliveryTypes' => 'MosseboShopCore\Support\Facades\DeliveryTypes',
        'Languages'     => 'MosseboShopCore\Support\Facades\Languages',
        'PayTypes'      => 'MosseboShopCore\Support\Facades\PayTypes',
        'OrderStatuses' => 'MosseboShopCore\Support\Facades\OrderStatuses',
        'PriceTypes'    => 'MosseboShopCore\Support\Facades\PriceTypes',
        'BadgeTypes'    => 'MosseboShopCore\Support\Facades\BadgeTypes',
        'Cities'        => 'MosseboShopCore\Support\Facades\Cities',
        'Countries'     => 'MosseboShopCore\Support\Facades\Countries',
        'Settings'      => 'MosseboShopCore\Support\Facades\Settings',
        'BannerPlaces'  => 'MosseboShopCore\Support\Facades\BannerPlaces',
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
        $this->publishMigrations();
        $this->publishAssets();
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

    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../public/assets/images/badges.svg' => public_path('vendor/images/badges.svg'),
        ], 'public');
    }

    protected function publishConfigs()
    {
        foreach ($this->configs as $key => $configFileName) {
            $this->publishes([
                $this->getConfigPath($configFileName) => $this->getConfigPublishPath($configFileName)
             ], $configFileName);
        }
    }

    private function publishMigrations()
    {
        $this->publishes([
            $this->getMigrationsPath() => database_path('migrations')
        ], 'migrations');
    }

    private function getMigrationsPath()
    {
        return __DIR__ . '/../database/migrations/';
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