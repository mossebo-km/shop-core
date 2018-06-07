<?php

namespace MosseboShopCore\Models\Shop;

use Kalnoy\Nestedset\NodeTrait;
use MosseboShopCore\Models\Base\BaseModelI18n;

class Category extends BaseModelI18n
{
    use NodeTrait;

    protected $tableIdentif = 'Categories';
    protected $translateRelationField = 'category_id';

    public function productsRelations()
    {
        return $this->hasMany(CategoryProduct::class, 'category_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class, CategoryProduct::class,
            'category_id', 'id', 'id', 'product_id'
        );
    }

    /**
     * Получение id-шников всех потомков.
     *
     * @param int $parentId
     * @param array $acc
     * @return array
     */
    public static function getDescendantIds($parentId = 0)
    {
        return array_column(self::descendantsOf($parentId)->toArray(), 'id');
    }
}