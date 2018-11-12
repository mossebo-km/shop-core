<?php

namespace MosseboShopCore\Models\Shop\Order;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Order extends BaseModel
{
    protected $tableKey = 'Orders';
    protected $relationFieldName = 'order_id';

    protected $fillable = [
        'user_id',
        'language_code',
        'price_type_id',
        'currency_code',
        'order_status_id',
        'pay_type_id',
        'delivery_type_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'city',
        'street',
        'house_number',
        'apartment',
        'floor',
        'entrance',
        'intercom',
        'post_code',
        'comment'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}