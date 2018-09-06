<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class AttributeOptionI18n extends BaseModel
{
    protected $tableKey = 'AttributeOptionsI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'option_id',
        'language_code',
        'value'
    ];

    public $timestamps = false;
}
