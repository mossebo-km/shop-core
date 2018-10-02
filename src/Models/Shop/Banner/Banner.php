<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Banner extends BaseModel
{
    use HasI18n, HasEnabledStatus;

    protected $tableKey = 'Banners';
    protected $relationFieldName = 'banner_id';

    protected $fillable = [
        'gradient',
        'title_color',
        'caption_color',
        'button_color',
        'button_background_color',
        'image',
        'background_1',
        'background_2',
        'enabled',
        'position',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
