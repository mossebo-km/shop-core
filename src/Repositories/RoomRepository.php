<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\RoomRepository as RoomRepositoryContract;

class RoomRepository extends RamRepository implements RoomRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n',
        'productCount',
        'productCounts',
        'image'
    ];

    protected function _productCountQueryModificator($query)
    {
        $modelTableName = \Config::get('tables.Rooms');
        $productsTableName = \Config::get('tables.RoomProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.room_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}