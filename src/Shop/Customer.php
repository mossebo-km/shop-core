<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;
use MosseboShopCore\Support\Traits\HasAttributes;
use Shop;

class Customer implements CustomerInterface
{
    use HasAttributes;

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function ordersCount(): int
    {
        return $this->getAttribute('ordersCount') ?: 0;
    }

    public function getPromoCodeUsesNum($promoCodeId): int
    {
        $promoCodesUses = $this->getAttribute('promoCodesUses');

        if ($promoCodesUses && isset($promoCodesUses[$promoCodeId])) {
            return count($promoCodesUses[$promoCodeId]);
        }

        return 0;
    }

    public function getPriceTypeId(): int
    {
        $priceTypeId = $this->getAttribute('price_type_id');

        return $priceTypeId ? $priceTypeId : Shop::getDefaultPriceTypeId();
    }
}