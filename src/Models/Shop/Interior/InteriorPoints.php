<?php

namespace MosseboShopCore\Models\Shop\Interior;

use MosseboShopCore\Models\Base\BaseModel;

abstract class InteriorPoints extends BaseModel
{
    protected $tableKey = 'InteriorPoints';

    protected $fillable = [
        'interior_id',
        'product_id',
        'position_x',
        'position_y',
        'is_similar'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}