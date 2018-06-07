<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class AttributeOption extends BaseModelI18n
{
    protected $tableIdentif = 'AttributeOptions';
    protected $relationFieldName = 'option_id';

    public function attribute()
    {
        return $this->hasOne(Attribute::class, $this->relationFieldName);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class, ProductAttributeOption::class,
            $this->relationFieldName, 'id', 'id', 'product_id'
        );
    }

    public function productRelations()
    {
        return $this->hasMany(ProductAttributeOption::class, $this->relationFieldName);
    }
}