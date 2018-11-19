<?php

namespace MosseboShopCore\Models\Shop\Cart;

use MosseboShopCore\Models\Base\BaseModel;

class Cart extends BaseModel
{
    protected $tableKey = 'Carts';
    protected $relationFieldName = 'cart_id';

    protected $fillable = [
        'user_id',
        'currency_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}