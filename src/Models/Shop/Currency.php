<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class Currency extends BaseModel
{
    protected $tableIdentif = 'Currencies';

    public function prices()
    {
        return $this->hasMany(Price::class, 'currency_code', 'code');
    }

    /**
     *
     *
     * @return string
     */
    public function getMaxValue() {
        return 2147483647 / pow(10 , $this->precision);
    }
}