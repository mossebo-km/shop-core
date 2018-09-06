<?php

namespace MosseboShopCore\Models\Shop\Badge;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BadgeTypeI18n extends BaseModel
{
    protected $tableKey = 'BadgeTypesI18n';

    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'badge_type_id',
        'language_code',
        'title',
    ];
}
