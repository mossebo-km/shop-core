<?php

namespace MosseboShopCore\Models;

use Shop;
use MosseboShopCore\Models\Base\Authenticatable;
use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;

abstract class User extends Authenticatable implements CustomerInterface
{
    protected $relationFieldName = 'user_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'api_token',

        'city',
        'street',
        'house_number',
        'apartment',
        'floor',
        'entrance',
        'intercom',
        'post_code',

        'is_franchisee',
        'price_type_id',
        'msb',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getId()
    {
        return $this->id;
    }

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
        $priceTypeId = $this->getAttribute('price_type_id');

        return $priceTypeId ? $priceTypeId : Shop::getDefaultPriceTypeId();
    }

    public function isFranchisee()
    {
        return $this->is_franchisee;
    }
}
