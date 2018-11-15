<?php

namespace MosseboShopCore\Models\Shop\Payment;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\Shop\StorePriceValueAsInteger;

abstract class Payment extends BaseModel
{
    use StorePriceValueAsInteger;

    protected $tableKey = 'YandexPayments';
    protected $relationFieldName = 'payment_id';

    protected $fillable = [
        'yandex_payment_id',
        'amount',
        'currency_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $priceAttributeKeys = [
        'amount'
    ];
}