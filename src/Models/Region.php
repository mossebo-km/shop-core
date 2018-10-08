<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\NestedTrait;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Region extends BaseModel
{
    use NestedTrait, HasEnabledStatus;

    protected $tableKey = 'Regions';

    protected $fillable = [
        'country_code',
        'name',
        'short_name',

        'fias_code',
        'okato_code',
        'aoguid',

        'parent_id',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
