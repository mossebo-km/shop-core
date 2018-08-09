<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use ScoutElastic\Searchable;
use MosseboShopCore\Elasticsearch\Configurators\ProductIndexConfigurator;

abstract class Product extends BaseModelI18n
{
    use Searchable;

    protected $indexConfigurator = ProductIndexConfigurator::class;

    protected $tableIdentif = 'Products';
    protected $relationFieldName = 'product_id';
    protected $mediaCollectionName = 'images';

    /**
     * Адрес товара на сайте.
     *
     * @return string
     */
    public function url()
    {
        return "/goods/{$this->id}";
    }

    public function scopeWhereStyle($query, $styleId)
    {
        $styleRelationsTableName = config('tables.StyleProducts');
        $productTableName = config('tables.Products');

        return $query->join($styleRelationsTableName, function($join) use($styleRelationsTableName, $productTableName, $styleId) {
            $join->on("{$styleRelationsTableName}.product_id", '=', "{$productTableName}.id")
                ->where("{$styleRelationsTableName}.style_id", $styleId);
        });
    }

    public function scopeWhereRoom($query, $roomId)
    {
        $roomRelationsTableName = config('tables.RoomProducts');
        $productTableName = config('tables.Products');

        return $query->join($roomRelationsTableName, function($join) use($roomRelationsTableName, $productTableName, $roomId) {
            $join->on("{$roomRelationsTableName}.product_id", '=', "{$productTableName}.id")
                ->where("{$roomRelationsTableName}.room_id", $roomId);
        });
    }

    public function scopeWhereCategory($query, $categoryId)
    {
        $categoryRelationsTableName = config('tables.CategoryProducts');
        $productTableName = config('tables.Products');

        return $query->join($categoryRelationsTableName, function($join) use($categoryRelationsTableName, $productTableName, $categoryId) {
            $join->on("{$categoryRelationsTableName}.product_id", '=', "{$productTableName}.id")
                ->where("{$categoryRelationsTableName}.category_id", $categoryId);
        });
    }

    public static function enabled()
    {
        $supplierTableName = config('tables.Suppliers');
        $productTableName = config('tables.Products');

        return self::select(\DB::raw("{$productTableName}.*"))
            ->where("{$productTableName}.enabled", 1)
            ->leftJoin("{$supplierTableName}", function($join) use($supplierTableName, $productTableName) {
                $join->on("{$supplierTableName}.id", '=', "{$productTableName}.supplier_id")
                    ->where("{$supplierTableName}.enabled", true);
            });
    }
}


