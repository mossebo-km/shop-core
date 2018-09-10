<?php

namespace MosseboShopCore\Models\Shop\Product;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class ProductSale extends BaseModel
{
    use HasEnabledStatus;

    protected $tableKey = 'ProductSales';

    protected $fillable = [
        'product_id',
        'date_start',
        'date_finish',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_start',
        'date_finish'
    ];
}