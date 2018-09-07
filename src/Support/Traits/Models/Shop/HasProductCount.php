<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasProductCount
{
    public function scopeWithProductCount($query)
    {
        $modelTableName = $this->getTable();
        $productsTableName = config('tables.ProductCounts');

        return $query->addSelect(\DB::raw("(\"{$productsTableName}\".\"count\") as \"products_count\""))
            ->leftJoin($productsTableName, "{$productsTableName}.{$this->relationFieldName}", '=', "{$modelTableName}.id")
            ->groupBy("{$modelTableName}.id");
    }
}