<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CategoryRepository as RoomRepositoryContract;
use MosseboShopCore\Models\Shop\Room;

class RoomRepository extends RamRepository implements RoomRepositoryContract
{
    protected $model = Room::class;

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

    protected function _withProductCount($query)
    {
        $modelTableName = \Config::get('tables.Rooms');
        $productsTableName = \Config::get('tables.RoomProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.room_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}