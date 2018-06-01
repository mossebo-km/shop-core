<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class Attribute extends BaseModelI18n
{
    /**
     * Идентификатор таблицы.
     *
     * @var string
     */
    protected $tableIdentif = 'Attributes';

    /**
     * Поле, через которое осуществляется связь с таблицей переводов.
     *
     * @var string
     */
    protected $translateRelationField = 'attribute_id';

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            ProductAttribute::class,
            'product_id',
            'attribute_id',
            'id',
            'id'
        );
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class, 'attribute_id');
    }
}
