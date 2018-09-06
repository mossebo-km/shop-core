<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class Attribute extends BaseModel
{
    use HasEnabledStatus, HasI18n;

    protected $tableKey = 'Attributes';
    protected $relationFieldName = 'attribute_id';

    protected $fillable = [
        'layout_class',
        'selectable',
        'enabled'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
