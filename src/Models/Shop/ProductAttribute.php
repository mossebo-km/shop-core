<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class ProductAttribute extends BaseModel
{
    protected $tableKey = 'ProductAttributes';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'attribute_id'
    ];

    public $timestamps = false;
}