<?php

namespace MosseboShopCore\Shop;

use Auth;
use MosseboShopCore\Shop\Shop\Traits\HasLanguage;
use MosseboShopCore\Shop\Shop\Traits\HasCurrency;
use MosseboShopCore\Shop\Shop\Traits\HasPriceTypes;

class Shop
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
}
