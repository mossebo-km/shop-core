<?php

namespace MosseboShopCore\Models\Shop\Category;

use MosseboShopCore\Models\Base\BaseModel;

abstract class CategoryProduct extends BaseModel
{
    protected $tableKey = 'CategoryProducts';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'category_id',
        'product_id'
    ];

    public $timestamps = false;
}
