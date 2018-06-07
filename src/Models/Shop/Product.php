<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class Product extends BaseModelI18n
{
    protected $tableIdentif = 'Products';
    protected $relationFieldName = 'product_id';
    protected $mediaCollectionName = 'images';

    public function prices()
    {
        return $this->morphMany(Price::class, 'item');
    }

    public function categoryRelations()
    {
        return $this->hasMany(CategoryProduct::class, $this->relationFieldName);
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class, CategoryProduct::class,
            $this->relationFieldName, 'id'
        );
    }

    public function attributes()
    {
        return $this->hasManyThrough(
            Attribute::class, ProductAttribute::class,
            $this->relationFieldName, 'id', 'id', 'attribute_id'
        );
    }

    public function attributeRelations()
    {
        return $this->hasMany(ProductAttribute::class, $this->relationFieldName);
    }

    public function attributeOptions()
    {
        return $this->hasManyThrough(
            AttributeOption::class, ProductAttributeOption::class,
            $this->relationFieldName, 'id', 'id', 'option_id'
        );
    }

    public function attributeOptionRelations()
    {
        return $this->hasMany(ProductAttributeOption::class, $this->relationFieldName);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    /**
     * Адрес товара на сайте.
     *
     * @return string
     */
    public function url()
    {
        return "/goods/{$this->id}";
    }
}


