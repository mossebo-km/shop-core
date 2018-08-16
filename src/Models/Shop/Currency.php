<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Contracts\Shop\Currency as CurrencyInterface;
use MosseboShopCore\Contracts\Shop\Price;

abstract class Currency extends BaseModel implements CurrencyInterface
{
    protected $tableIdentif = 'Currencies';

    /**
     * Максимальное значение цены для текущей валюты
     *
     * @return string
     */
    public function getMaxPriceValue() {
        return 2147483647 / pow(10 , $this->getPrecision());
    }

    public function getPrecision()
    {
        return $this->precision;
    }

    public function getDecimalSeparator()
    {
        return $this->decimal_separator;
    }

    public function getThousandSeparator()
    {
        return $this->thousand_separator;
    }

    public function isSymbolAfterPrice(): bool
    {
        return $this->swap_currency_symbol;
    }

    public function formatPrice($price): string
    {
        $formattedPrice = number_format(
            $price,
            $this->getPrecision(),
            $this->getDecimalSeparator(),
            $this->getThousandSeparator()
        );

        $formattedPrice = str_replace(
            '.' . str_pad('', $this->getPrecision(), '0'),
            '',
            $formattedPrice
        );

        if ($this->isSymbolAfterPrice()) {
            $formattedPrice = "$formattedPrice $symbol";
        }
        else {
            $formattedPrice = "$symbol $formattedPrice";
        }

        return $formattedPrice;
    }
}