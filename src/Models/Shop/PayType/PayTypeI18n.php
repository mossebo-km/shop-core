<?php

namespace MosseboShopCore\Models\Shop\PayType;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PayTypeI18n extends BaseModel
{
    protected $tableKey = 'PayTypesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'pay_type_id',
        'language_code',
        'name',
    ];

    public $timestamps = false;
}