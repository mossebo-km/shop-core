<?php

namespace MosseboShopCore\Models\Shop\Category;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\NestedTrait;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasProductCount;

use MosseboShopCore\Contracts\Models\HasMorphRelation as HasMorphRelationInterface;
use MosseboShopCore\Support\Traits\Models\HasMorphRelation;

abstract class Category extends BaseModel implements HasMorphRelationInterface
{
    use NestedTrait, HasEnabledStatus, HasI18n, HasProductCount, HasMorphRelation;

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

    protected $morphTypeName = 'category';
}