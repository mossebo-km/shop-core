<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class CategoryI18n extends BaseModel
{
    protected $tableIdentif = 'CategoriesI18n';

    protected $fillable = [
        'category_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];
}
