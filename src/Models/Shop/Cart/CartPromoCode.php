<?php

namespace MosseboShopCore\Models\Shop\Cart;

use MosseboShopCore\Models\Base\BaseModel;

class CartPromoCode extends BaseModel
{
    protected $tableKey = 'CartPromoCodes';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'cart_id',
        'promo_code_id',
    ];

    public $timestamps = false;
}