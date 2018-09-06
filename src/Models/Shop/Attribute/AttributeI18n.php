<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class AttributeI18n extends BaseModel
{
    protected $tableKey = 'AttributesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'attribute_id',
        'language_code',
        'title'
    ];

    public $timestamps = false;
}
