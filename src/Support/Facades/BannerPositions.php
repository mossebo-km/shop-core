<?php

namespace MosseboShopCore\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Categories
 * @package MosseboShopCore\Support\Facades
 */
class BannerPositions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'banner-positions';
    }
}