<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class AttributeOption extends BaseModelI18n
{
    /**
     * Идентификатор таблицы.
     *
     * @var string
     */
    protected $tableIdentif = 'AttributeOptions';

    /**
     * Поле, через которое осуществляется связь с таблицей переводов.
     *
     * @var string
     */
    protected $translateRelationField = 'option_id';

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'attribute_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class, ProductAttributeOption::class,
            'option_id', 'id', 'id', 'product_id'
        );
    }

    public function productRelations()
    {
        return $this->hasMany(ProductAttributeOption::class, 'option_id');
    }
}