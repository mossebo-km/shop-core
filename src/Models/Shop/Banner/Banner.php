<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class Banner extends BaseModel
{
    use HasI18n;

    protected $tableKey = 'Banners';
    protected $relationFieldName = 'banner_id';

    protected $fillable = [
        'gradient',
        'title_color',
        'caption_color',
        'button_color',
        'button_background_color',
        'small_image',
        'mobile_image',
        'desktop_image',
        'background_image',
        'enabled',
        'position',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
