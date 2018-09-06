<?php

namespace MosseboShopCore\Models\Shop\Style;

use MosseboShopCore\Models\Base\BaseModel;

abstract class StyleI18n extends BaseModel
{
    protected $tableKey = 'StylesI18n';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'style_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = false;
}
