<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BannerPlaceRelation extends BaseModel
{
    protected $tableKey = 'BannerPlaceRelations';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'place_id',
        'banner_id',
    ];

    public $timestamps = false;
}
