<?php

namespace MosseboShopCore\Models;

use Shop;
use MosseboShopCore\Models\Base\Authenticatable;
use MosseboShopCore\Contracts\Shop\User as UserInterface;

abstract class User extends Authenticatable implements UserInterface
{
    protected $relationFieldName = 'user_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'post_code',
        'password',
        'api_token',
        'is_franchisee',
        'price_type_id',
        'msb'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

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
        return $this->is_franchisee;
    }
}
