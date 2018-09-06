<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class OrderStatus extends BaseModel
{
    use HasI18n;

    protected $tableKey = 'OrderStatuses';
    protected $relationFieldName = 'order_status_id';

    protected $fillable = [
        'color',
        'position'
    ];

    public $timestamps = false;
}