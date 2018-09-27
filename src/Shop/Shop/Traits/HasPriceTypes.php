<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Auth;
use PriceTypes;

trait HasPriceTypes
{
    protected $language = null;

    public function getDefaultPriceTypeId()
    {
        return config('shop.price.types.default');
    }

    public function getCurrentPriceTypeId()
    {
        $user = Auth::user();

        if ($user && $user->isFranchisee()) {
            return config('shop.price.types.franchisee');
        }

        return $this->getDefaultPriceTypeId();
    }
}
