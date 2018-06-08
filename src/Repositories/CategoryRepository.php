<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CategoryRepository as CategoryRepositoryContract;

class CategoryRepository extends RamRepository implements CategoryRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n',
        'productCount',
        'image'
    ];

    public function getTree($modificators)
    {
        return $this->getCollection($modificators)->toTree();
    }

    // todo: // RoomRepository, StyleRepository - повторяется
    protected function _withProductCount($query)
    {
        $modelTableName = \Config::get('tables.Categories');
        $productsTableName = \Config::get('tables.CategoryProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.category_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}