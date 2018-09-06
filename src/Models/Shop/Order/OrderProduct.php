<?php

namespace MosseboShopCore\Models\Shop\Order;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\Shop\StorePriceValueAsInteger;

abstract class OrderProduct extends BaseModel
{
    use StorePriceValueAsInteger;

    protected $tableKey = 'OrderProducts';

    protected $priceAttributeKeys = [
        'default_price',
        'final_price'
    ];

    protected $fillable = [
        'order_id',
        'product_id',
        'default_price',
        'final_price',
        'currency_code',
        'quantity',
        'params'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}