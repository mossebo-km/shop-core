<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CategoryRepository as CategoryRepositoryContract;
use MosseboShopCore\Models\Shop\Category;

class CategoryRepository extends RamRepository implements CategoryRepositoryContract
{
    protected $model = Category::class;

    protected $modificators = [
        'i18n', 'currentI18n', 'productCount'
    ];

    public function getTree($modificators)
    {
        return $this->getCollection($modificators)->toTree();
    }

    protected function _withI18n($query)
    {
        return $query->with('i18n');
    }

    protected function _withCurrentI18n($query)
    {
        return $query->with('currentI18n');
    }

    protected function _withProductCount($query)
    {
        $categoriesTableName = \Config::get('tables.Categories');
        $categoryProductsTableName = \Config::get('tables.CategoryProducts');

        return $query->select(\DB::raw("\"{$categoriesTableName}\".*, count(\"{$categoryProductsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($categoryProductsTableName, "{$categoryProductsTableName}.category_id", '=', "{$categoriesTableName}.id")
            ->groupBy("{$categoriesTableName}.id");
    }
}