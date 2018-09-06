<?php

namespace MosseboShopCore\Models\Shop\Order;

use MosseboShopCore\Models\Base\BaseModel;

abstract class OrderStatusI18n extends BaseModel
{
    protected $tableKey = 'OrderStatusesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'order_status_id',
        'language_code',
        'name',
    ];

    public $timestamps = false;
}