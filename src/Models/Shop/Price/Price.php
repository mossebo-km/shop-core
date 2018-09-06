<?php

namespace MosseboShopCore\Models\Shop\Price;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Shop\Price as ShopPrice;
use MosseboShopCore\Support\Traits\Models\Shop\StorePriceValueAsInteger;

abstract class Price extends BaseModel
{
    use StorePriceValueAsInteger;

    protected $tableKey = 'Prices';

    protected $fillable = [
        'item_type',
        'item_id',
        'currency_code',
        'price_type_id',
        'value'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

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