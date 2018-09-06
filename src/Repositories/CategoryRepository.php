<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CategoryRepository as CategoryRepositoryContract;

class CategoryRepository extends BaseRepository implements CategoryRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n',
        'productCount',
        'productCounts',
        'image'
    ];

    public function getTree($modificators)
    {
        return $this->getCollection($modificators)->toTree();
    }

    // todo: // RoomRepository, StyleRepository - повторяется
    protected function _productCountQueryModificator($query)
    {
        $modelTableName = \Config::get('tables.Categories');
        $productsTableName = \Config::get('tables.CategoryProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.category_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}