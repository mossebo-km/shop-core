<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\NestedTrait;

class Style extends BaseModelI18n
{
    use NestedTrait;

    protected $tableIdentif = 'Styles';
    protected $relationFieldName = 'style_id';

    public function productsRelations()
    {
        return $this->hasMany(StyleProduct::class, $this->relationFieldName);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class, StyleProduct::class,
            $this->relationFieldName, 'id', 'id', 'product_id'
        );
    }
}