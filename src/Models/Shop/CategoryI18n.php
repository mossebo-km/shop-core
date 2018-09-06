<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class CategoryI18n extends BaseModel
{
    protected $tableKey = 'CategoriesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'category_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = false;
}
