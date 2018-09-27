<?php

namespace MosseboShopCore\Models;

use Shop;
use MosseboShopCore\Models\Base\Authenticatable;
use MosseboShopCore\Contracts\Shop\User as UserInterface;

abstract class User extends Authenticatable implements UserInterface
{
    protected $relationFieldName = 'user_id';

    public function ordersCount(): int
    {
        return $this->orders()->count();
    }

    public function getPromoCodeUsesNum($promoCodeId): int
    {
        return $this->promoCodeUses()->where('id', $promoCodeId)->count();
    }

    public function getPriceTypeId(): int
    {
        return Shop::getDefaultPriceTypeId();
    }

    public function isFranchisee()
    {

    }
}
