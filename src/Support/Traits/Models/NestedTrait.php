<?php

namespace MosseboShopCore\Support\Traits\Models;

use Kalnoy\Nestedset\NodeTrait;

trait NestedTrait
{
    use NodeTrait;

    /**
    * Получение id-шников всех потомков.
    *
    * @param int $parentId
    * @param array $acc
    * @return array
    */
    public static function getDescendantIds($parentId = 0)
    {
        return array_column(self::descendantsOf($parentId)->toArray(), 'id');
    }
}