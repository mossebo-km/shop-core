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

    public function isFranchiseeDomain()
    {
        return strpos(request()->getHost(), 'f.') === 0;
    }

    public function getUser()
    {
        $prefix = app('request')->route()->getPrefix();

        if (strpos($prefix, 'api/') === 0) {
            return Auth::guard('api')->user();
        }

        return Auth::user();
    }

    public function userIsFranchisee()
    {
        $user = $this->getUser();

        return $user && $user->isFranchisee();
    }
}
