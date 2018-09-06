<?php

namespace MosseboShopCore\Models\Shop\Style;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;

abstract class Style extends BaseModel
{
    use HasI18n;

    protected $tableKey = 'Styles';
    protected $relationFieldName = 'style_id';

    protected $fillable = [
        'slug',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}