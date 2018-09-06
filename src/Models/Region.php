<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\NestedTrait;

abstract class Region extends BaseModel
{
    use NestedTrait;

    protected $tableKey = 'Regions';

    protected $fillable = [
        'country_code',
        'name',
        'short_name',
        'aoguid',

        'area_code',
        'region_code',

        'parent_id',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
