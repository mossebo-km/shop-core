<?php

namespace MosseboShopCore\Models\Shop\DeliveryType;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class DeliveryType extends BaseModel
{
    use HasI18n, HasEnabledStatus;

    protected $tableKey = 'DeliveryTypes';
    protected $relationFieldName = 'delivery_type_id';

    public $timestamps = false;

    protected $fillable = [
        'position',
        'enabled'
    ];
}