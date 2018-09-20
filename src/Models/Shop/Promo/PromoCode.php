<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class PromoCode extends BaseModel
{
    use HasI18n, HasEnabledStatus;

    protected $tableKey = 'PromoCodes';
    protected $relationFieldName = 'promo_code_id';

    protected $fillable = [
        'name',
        'date_start',
        'date_finish',
        'quantity',
        'quantity_per_user',
        'amount',
        'percent',
        'currency_code',
        'enabled',
        'position',
        'uses_count'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_start',
        'date_finish'
    ];
}
