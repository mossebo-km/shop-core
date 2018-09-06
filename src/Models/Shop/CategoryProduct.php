<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class CategoryProduct extends BaseModel
{
    protected $tableIdentif = 'CategoryProducts';

    protected $fillable = [
        'category_id',
        'product_id'
    ];
}
