<?php

namespace MosseboShopCore\Models\Shop\Category;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\NestedTrait;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasProductCount;

abstract class Category extends BaseModel
{
    use NestedTrait, HasEnabledStatus, HasI18n, HasProductCount;

    protected $tableKey = 'Categories';
    protected $relationFieldName = 'category_id';

    protected $fillable = [
        'parent_id',
        'slug',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}