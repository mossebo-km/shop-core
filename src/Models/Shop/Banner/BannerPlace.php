<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BannerPlace extends BaseModel
{
    protected $tableKey = 'BannerPlaces';
    protected $relationFieldName = 'place_id';

    protected $fillable = [
        'name',
        'enabled',
        'position',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
