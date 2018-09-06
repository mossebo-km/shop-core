<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class AttributeI18n extends BaseModel
{
    protected $tableIdentif = 'AttributesI18n';

    protected $fillable = [
        'attribute_id',
        'language_code',
        'title'
    ];
}
