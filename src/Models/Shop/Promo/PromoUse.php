<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PromoUse extends BaseModel
{
    protected $tableKey = 'PromoUses';

    protected $fillable = [
        'promo_code_id',
        'user_id',
        'order_id',
        'amount',
        'percent',
        'currency_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
