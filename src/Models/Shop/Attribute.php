<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class Attribute extends BaseModelI18n
{
    protected $tableIdentif = 'Attributes';
    protected $relationFieldName = 'attribute_id';

    public function productRelations()
    {
        return $this->hasMany(ProductAttribute::class, $this->relationFieldName);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            ProductAttribute::class,
            $this->relationFieldName,
            'id',
            'id',
            'product_id'
        );
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class, $this->relationFieldName);
    }
}
