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


    // Удаление предка - обнуляет parent_id потомков
    public function delete()
    {
        \DB::transaction(function() {
            self::where('parent_id', $this->id)->update([
                'parent_id' => 0
            ]);

            parent::delete();
        });
    }
}