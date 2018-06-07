<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class Product extends BaseModelI18n
{
    protected $mediaCollectionName = 'images';

    /**
     * Идентификатор таблицы.
     *
     * @var string
     */
    protected $tableIdentif = 'Products';

    /**
     * Поле, через которое осуществляется связь с таблицей переводов.
     *
     * @var string
     */
    protected $translateRelationField = 'product_id';

    public function prices()
    {
        return $this->morphMany(Price::class, 'item');
    }

    public function categoryRelations()
    {
        return $this->hasMany(CategoryProduct::class, 'product_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class, CategoryProduct::class,
            'product_id', 'id'
        );
    }

    public function attributes()
    {
        return $this->hasManyThrough(
            Attribute::class, ProductAttribute::class,
            'product_id', 'id', 'id', 'attribute_id'
        );
    }

    public function attributeRelations()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function attributeOptions()
    {
        return $this->hasManyThrough(
            AttributeOption::class, ProductAttributeOption::class,
            'product_id', 'id', 'id', 'option_id'
        );
    }

    public function attributeOptionRelations()
    {
        return $this->hasMany(ProductAttributeOption::class, 'product_id');
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


