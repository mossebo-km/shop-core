<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Contracts\Models\Shop\Promo\PromoCondition as PromoConditionInterface;

abstract class PromoCondition extends BaseModel implements PromoConditionInterface
{
    protected $tableKey = 'PromoConditions';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'params',
        'promo_code_id',
    ];
}
