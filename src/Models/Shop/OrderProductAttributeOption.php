<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class OrderProductAttributeOption extends BaseModel
{
    protected $tableKey = 'OrderProductAttributeOptions';

    protected $fillable = [
        'order_product_id',
        'option_id',
    ];

    public $timestamps = false;
}