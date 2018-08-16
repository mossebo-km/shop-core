<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\Shop\StorePriceValueAsInteger;

abstract class OrderProduct extends BaseModel
{
    use StorePriceValueAsInteger;

    protected $tableIdentif = 'OrderProducts';

    protected $priceAttributeKeys = [
        'default_price',
        'final_price'
    ];
}