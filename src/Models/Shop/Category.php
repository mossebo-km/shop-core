<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\NestedTrait;

class Category extends BaseModelI18n
{
    use NestedTrait;

    protected $tableIdentif = 'Categories';
    protected $relationFieldName = 'category_id';

    public function productsRelations()
    {
        return $this->hasMany(CategoryProduct::class, $this->relationFieldName);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class, CategoryProduct::class,
            $this->relationFieldName, 'id', 'id', 'product_id'
        );
    }
}