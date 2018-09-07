<?php

namespace MosseboShopCore\Models\Shop\PriceType;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class PriceType extends BaseModel
{
    use HasI18n, HasEnabledStatus;

    protected $tableKey = 'PriceTypes';
    protected $relationFieldName = 'price_type_id';

    protected $fillable = [
        'default',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function prices()
    {
        return $this->morphMany(Price::class, $this->relationFieldName);
    }
}