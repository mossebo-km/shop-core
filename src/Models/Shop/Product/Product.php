<?php

namespace MosseboShopCore\Models\Shop\Product;

use ScoutElastic\Searchable;
use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Elasticsearch\Configurators\ProductIndexConfigurator;
use MosseboShopCore\Contracts\Shop\Product\Product as ProductInterface;
use MosseboShopCore\Contracts\Models\HasMorphRelation as HasMorphRelationInterface;
use MosseboShopCore\Support\Traits\Models\HasMorphRelation;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Product extends BaseModel implements ProductInterface, HasMorphRelationInterface
{
    use Searchable, HasI18n, HasEnabledStatus, HasMorphRelation;

    protected $indexConfigurator = ProductIndexConfigurator::class;

    protected $tableKey = 'Products';
    protected $relationFieldName = 'product_id';
    protected $mediaCollectionName = 'images';

    protected $fillable = [
        'supplier_id',
        'quantity',
        'showed',
        'bought',
        'enabled',
        'is_payable',
        'width',
        'height',
        'length',
        'weight'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $mapping = [
        'properties' => [
            'index' => [
                'type' => 'text',
            ],
        ]
    ];

    protected $morphTypeName = 'product';

    public function toSearchableArray()
    {
        $index = [
            $this->id
        ];

        foreach ($this->i18n as $translate) {
            $index[] = $translate->title;
            $index[] = $translate->description;
        }

        foreach ($this->attributeOptions as $option) {
            foreach ($option->i18n as $translate) {
                $index[] = $translate->value;
            }
        }

        foreach ($this->categories as $category) {
            foreach ($category->i18n as $translate) {
                $index[] = $translate->title;
            }
        }

        foreach ($this->styles as $style) {
            foreach ($style->i18n as $translate) {
                $index[] = $translate->title;
            }
        }

        foreach ($this->rooms as $room) {
            foreach ($room->i18n as $translate) {
                $index[] = $translate->title;
            }
        }

        $index = array_unique($index);

        return [
            'index' => join(' ', preg_replace('/\s\s+/', ' ', $index)),
        ];
    }

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
            $join->on("{$styleRelationsTableName}.product_id", '=', "{$productTableName}.id");

            if (is_array($styleId)) {
                $join->whereIn("{$styleRelationsTableName}.style_id", $styleId);
            }
            else {
                $join->where("{$styleRelationsTableName}.style_id", $styleId);
            }
        });
    }

    public function scopeWhereRoom($query, $roomId)
    {
        $roomRelationsTableName = config('tables.RoomProducts');
        $productTableName = config('tables.Products');

        return $query->join($roomRelationsTableName, function($join) use($roomRelationsTableName, $productTableName, $roomId) {
            $join->on("{$roomRelationsTableName}.product_id", '=', "{$productTableName}.id");

            if (is_array($roomId)) {
                $join->whereIn("{$roomRelationsTableName}.room_id", $roomId);
            }
            else {
                $join->where("{$roomRelationsTableName}.room_id", $roomId);
            }
        });
    }

    public function scopeWhereCategory($query, $categoryId)
    {
        $categoryRelationsTableName = config('tables.CategoryProducts');
        $productTableName = config('tables.Products');

        return $query->join($categoryRelationsTableName, function($join) use($categoryRelationsTableName, $productTableName, $categoryId) {
            $join->on("{$categoryRelationsTableName}.product_id", '=', "{$productTableName}.id");

            if (is_array($categoryId)) {
                $join->whereIn("{$categoryRelationsTableName}.category_id", $categoryId);
            }
            else {
                $join->where("{$categoryRelationsTableName}.category_id", $categoryId);
            }
        });
    }

    public function scopeEnabled($query)
    {
        $supplierTableName = config('tables.Suppliers');
        $productTableName = config('tables.Products');

        return $query->addSelect(\DB::raw("{$supplierTableName}.enabled as supplier_enabled"))
            ->leftJoin("{$supplierTableName}", function($join) use($supplierTableName, $productTableName) {
                $join->on("{$supplierTableName}.id", '=', "{$productTableName}.supplier_id")
                    ->where("{$productTableName}.enabled", 1)
                    ->groupBy("supplier_enabled")
                    ->where("{$supplierTableName}.enabled", true);
            });
    }
}


