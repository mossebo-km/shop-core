<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class StyleProduct extends BaseModel
{
    protected $tableKey = 'StyleProducts';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'style_id',
        'product_id'
    ];

    public $timestamps = false;
}
