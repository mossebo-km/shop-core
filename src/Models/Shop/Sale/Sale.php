<?php

namespace MosseboShopCore\Models\Shop\Sale;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Sale extends BaseModel
{
    use HasEnabledStatus;

    protected $tableKey = 'Sales';

    protected $fillable = [
        'item_id',
        'item_type',
        'date_start',
        'date_finish',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_start',
        'date_finish'
    ];

    public function item()
    {
        return $this->morphTo();
    }
}