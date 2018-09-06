<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\StyleRepository as StyleRepositoryContract;

class StyleRepository extends BaseRepository implements StyleRepositoryContract
{
    protected $model = Style::class;

    protected $modificators = [
        'i18n',
        'currentI18n',
        'productCount',
        'productCounts',
        'image'
    ];

    protected function _productCountQueryModificator($query)
    {
        $modelTableName = config('tables.Styles');
        $productsTableName = config('tables.StyleProducts');

        return $query->select(\DB::raw("\"{$modelTableName}\".*, count(\"{$productsTableName}\".\"product_id\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.style_id", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}