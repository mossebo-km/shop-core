<?php

namespace MosseboShopCore\Models\Shop\Badge;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Badge extends BaseModel
{
    protected $tableKey = 'Badges';
    protected $relationFieldName = 'badge_type_id';

    protected $fillable = [
        'item_id',
        'item_type',
        'badge_type_id',
        'value',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
