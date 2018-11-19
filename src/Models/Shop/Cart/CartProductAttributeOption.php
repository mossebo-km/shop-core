<?php

namespace MosseboShopCore\Models\Shop\Cart;

use MosseboShopCore\Models\Base\BaseModel;

class CartProductAttributeOption extends BaseModel
{
    protected $tableKey = 'CartProductAttributeOptions';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'cart_product_id',
        'option_id',
    ];

    public $timestamps = false;
}