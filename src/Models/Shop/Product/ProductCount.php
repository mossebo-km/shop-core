<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class ProductCount extends BaseModel
{
    protected $tableKey = 'ProductCounts';

    protected $fillable = [
        'category_id',
        'room_id',
        'style_id',
        'count'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}