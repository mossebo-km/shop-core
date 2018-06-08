<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CategoryRepository as StyleRepositoryContract;
use MosseboShopCore\Models\Shop\Style;

class StyleRepository extends RamRepository implements StyleRepositoryContract
{
    protected $model = Style::class;

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
        $modelTableName = \Config::get('tables.Styles');
        $productsTableName = \Config::get('tables.StyleProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.style_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}