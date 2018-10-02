<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class BannerPlace extends BaseModel
{
    use HasEnabledStatus;

    protected $tableKey = 'BannerPlaces';
    protected $relationFieldName = 'place_id';

    protected $fillable = [
        'name',
        'type',
        'enabled',
        'position',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
