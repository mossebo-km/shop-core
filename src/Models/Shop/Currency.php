<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Currency extends BaseModel
{
    protected $tableIdentif = 'Currencies';

    /**
     * Максимальное значение цены для текущей валюты
     *
     * @return string
     */
    public function getMaxValue() {
        return 2147483647 / pow(10 , $this->precision);
    }
}