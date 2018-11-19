<?php

namespace MosseboShopCore\Models\Shop\Cart;

use MosseboShopCore\Models\Base\BaseModel;

class CartProduct extends BaseModel
{
    protected $tableKey = 'CartProducts';
    protected $relationFieldName = 'cart_product_id';

    protected $fillable = [
        'cart_id',
        'product_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}