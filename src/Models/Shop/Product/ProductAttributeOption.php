<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class ProductAttributeOption extends BaseModel
{
    protected $tableKey = 'ProductAttributeOptions';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'attribute_id',
        'product_id',
        'option_id'
    ];

    public $timestamps = false;
}
