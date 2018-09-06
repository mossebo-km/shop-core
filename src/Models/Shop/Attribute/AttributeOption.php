<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class AttributeOption extends BaseModel
{
    use HasEnabledStatus, HasI18n;

    protected $tableKey = 'AttributeOptions';
    protected $relationFieldName = 'option_id';

    protected $fillable = [
        'attribute_id',
        'position',
        'enabled'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}