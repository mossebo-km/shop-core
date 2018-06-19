<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\StyleRepository as StyleRepositoryContract;
class StyleRepository extends RamRepository implements StyleRepositoryContract
{
    protected $model = Style::class;

    protected $modificators = [
        'i18n',
        'currentI18n',
        'productCount',
        'image'
    ];

    protected function _productCountQueryModificator($query)
    {
        $modelTableName = \Config::get('tables.Styles');
        $productsTableName = \Config::get('tables.StyleProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.style_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}