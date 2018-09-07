<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasProductCount
{
    public function scopeWithProductCount($query)
    {
        $modelTableName = $this->getTable();
        $productsCountTableName = config('tables.ProductCounts');

        return $query
            ->select(\DB::raw("DISTINCT on ({$modelTableName}.id) {$modelTableName}.*"))
            ->addSelect(\DB::raw("\"{$productsCountTableName}\".\"count\" as \"products_count\""))
            ->groupBy(\DB::raw("{$modelTableName}.{$this->getKeyName()},  products_count"))
            ->leftJoin($productsCountTableName, "{$productsCountTableName}.{$this->relationFieldName}", '=', "{$modelTableName}.{$this->getKeyName()}");
    }
}