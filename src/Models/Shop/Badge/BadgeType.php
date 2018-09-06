<?php

namespace MosseboShopCore\Models\Shop\Badge;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class BadgeType extends BaseModel
{
    use HasI18n;

    protected $tableKey = 'BadgeTypes';
    protected $relationFieldName = 'badge_type_id';

    protected $fillable = [
        'icon',
        'color',
        'has_value',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
