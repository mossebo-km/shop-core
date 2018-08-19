<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\Authenticatable;
use MosseboShopCore\Contracts\Shop\User as UserInterface;

abstract class User extends Authenticatable implements UserInterface
{
    protected $relationFieldName = 'user_id';


    public function ordersCount(): integer
    {
        return $this->orders()->count();
    }

    public function getPromoCodeUsesNum($promoCodeId): integer
    {
        return $this->promoCodeUses()->where('id', $promoCodeId)->count();
    }
}
