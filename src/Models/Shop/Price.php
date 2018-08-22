<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Shop\Price as ShopPrice;
use MosseboShopCore\Support\Traits\Models\Shop\StorePriceValueAsInteger;

abstract class Price extends BaseModel
{
    use StorePriceValueAsInteger;

    protected $tableIdentif = 'Prices';

    protected $priceAttributeKeys = [
        'value'
    ];

    /**
     * Получение форматированной (побитой на разряды, с символом валюты) цены.
     *
     * @return mixed|string
     */
    public function getFormatted()
    {
        return ShopPrice::formatPrice(
            $this->value,
            $this->currency_code
        );
    }
}