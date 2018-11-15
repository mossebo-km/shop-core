<?php

namespace MosseboShopCore\Models\Shop\PayType;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class PayType extends BaseModel
{
    use HasI18n, HasEnabledStatus;

    protected $tableKey = 'PayTypes';
    protected $relationFieldName = 'pay_type_id';

    protected $fillable = [
        'default',
        'enabled',
        'position',
    ];

    public $timestamps = false;
}