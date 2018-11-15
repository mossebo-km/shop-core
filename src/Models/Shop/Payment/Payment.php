<?php

namespace MosseboShopCore\Models\Shop\Payment;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Payment extends BaseModel
{
    protected $tableKey = 'Payments';
    protected $relationFieldName = 'payment_id';

    protected $fillable = [
        'order_id',
        'payment_id',
        'payment_type',
        'status'
    ];

    public $timestamps = false;

    public function details()
    {
        return $this->morphTo();
    }
}