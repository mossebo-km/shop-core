<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Shop\Shop\Traits\HasLanguage;
use MosseboShopCore\Shop\Shop\Traits\HasCurrency;

class Shop
{
    use HasLanguage, HasCurrency;

    public function hasLanguage()
    {
        return true;
    }

    public function hasCurrency()
    {
        return true;
    }
}
