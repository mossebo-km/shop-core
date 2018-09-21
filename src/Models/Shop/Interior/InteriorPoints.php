<?php

namespace MosseboShopCore\Models\Shop\Order;

use MosseboShopCore\Models\Base\BaseModel;

abstract class InteriorPoints extends BaseModel
{
    protected $tableKey = 'InteriorPoints';

    protected $fillable = [
        'position_x',
        'position_y',
        'product_id',
        'is_similar'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}