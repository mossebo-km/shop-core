<?php

namespace MosseboShopCore\Models\Shop\Order;

use MosseboShopCore\Models\Base\BaseModel;
//use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class Interior extends BaseModel
{
//    use HasI18n;

    protected $tableKey = 'Interiors';
    protected $relationFieldName = 'interior_id';

    protected $fillable = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}