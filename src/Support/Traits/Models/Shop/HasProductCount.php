<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasProductCount
{
    public function scopeWithProductCount($query)
    {
        $productsCountTableName = config('tables.ProductCounts');

        return $query
            ->addSelect(\DB::raw("{$productsCountTableName}.count as products_count"))
            ->groupBy(\DB::raw("products_count"))
            ->leftJoin($productsCountTableName, function ($join) use($productsCountTableName) {
                $foreignKey = $this->getForeignKey();

                $join->on("{$productsCountTableName}.{$foreignKey}", '=', "{$this->getTable()}.{$this->getKeyName()}");

                foreach (['category_id', 'style_id', 'room_id'] as $fieldKey) {
                    if ($foreignKey !== $fieldKey) {
                        $join->whereNull($fieldKey);
                    }
                }
            });
    }
}
