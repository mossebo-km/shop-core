<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\NestedTrait;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Category extends BaseModelI18n
{
    use NestedTrait, HasEnabledStatus;

    protected $tableIdentif = 'Categories';
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