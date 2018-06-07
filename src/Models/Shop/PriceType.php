<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class PriceType extends BaseModelI18n
{
    protected $tableIdentif = 'PriceTypes';
    protected $relationFieldName = 'price_type_id';

    public function prices()
    {
        return $this->morphMany(Price::class, $this->relationFieldName);
    }
}