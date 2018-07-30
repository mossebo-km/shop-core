<?php

namespace MosseboShopCore\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PriceTypes
 * @package MosseboShopCore\Support\Facades
 */
class OrderStatuses extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'order-statuses';
    }
}