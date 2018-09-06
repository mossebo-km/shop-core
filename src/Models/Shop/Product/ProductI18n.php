<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class ProductI18n extends BaseModel
{
    protected $tableKey = 'ProductsI18n';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = false;
}