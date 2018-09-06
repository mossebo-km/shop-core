<?php

namespace MosseboShopCore\Models\Shop\Product;

use MosseboShopCore\Models\Base\BaseModel;

abstract class RelatedProduct extends BaseModel
{
    protected $tableKey = 'RelatedProducts';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'related_id'
    ];

    public $timestamps = false;
}
