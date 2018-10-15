<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use PriceTypes;

trait HasPriceTypes
{
    protected $language = null;

    public function getDefaultPriceTypeId()
    {
        return config('shop.price.types.default');
    }

    public function getPriceTypeId($type)
    {
        return config('shop.price.types.' . $type);
    }
}
