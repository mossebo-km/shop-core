<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BannerI18n extends BaseModel
{
    protected $tableKey = 'BannersI18n';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'banner_id',
        'language_code',
        'title',
        'caption',
        'button',
        'link'
    ];

    public $timestamps = false;
}
