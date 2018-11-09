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
        $item = static::where('id', $parentId)->first();

        if (! $item) {
            return [];
        }

        return array_column(static::rawQuery()->descendantsOf($item)->toArray(), 'id');
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