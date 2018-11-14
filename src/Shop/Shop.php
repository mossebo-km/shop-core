<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Shop as ShopInterface;

use Auth;
use MosseboShopCore\Shop\Shop\Traits\HasLanguage;
use MosseboShopCore\Shop\Shop\Traits\HasCurrency;
use MosseboShopCore\Shop\Shop\Traits\HasPriceTypes;

abstract class Shop implements ShopInterface
{
    use HasLanguage, HasCurrency, HasPriceTypes;

    public function hasLanguage()
    {
        return true;
    }

    public function hasCurrency()
    {
        return true;
    }

    public function hasPriceTypes()
    {
        return true;
    }

    public function getAvailableProductOptionIds($productId)
    {
        return [];
    }

    public function call($callable, $params = null)
    {
        return app()->call($callable, $params);
    }
}
