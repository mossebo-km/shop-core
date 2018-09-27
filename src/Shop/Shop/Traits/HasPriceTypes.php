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

    public function getCurrentPriceTypeId()
    {
        if ($this->isFranchiseeDomain()) {
            $user = $this->getUser();

            if ($user && $user->isFranchisee()) {
                return config('shop.price.types.franchisee');
            }
        }

        return $this->getDefaultPriceTypeId();
    }
}
