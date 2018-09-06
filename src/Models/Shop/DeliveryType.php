<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class DeliveryType extends BaseModel
{
    use HasI18n;

    protected $tableKey = 'DeliveryTypes';
    protected $relationFieldName = 'delivery_type_id';

    public $timestamps = false;

    protected $fillable = [
        'position',
        'enabled'
    ];
}