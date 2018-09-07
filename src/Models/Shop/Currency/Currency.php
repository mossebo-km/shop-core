<?php

namespace MosseboShopCore\Models\Shop\Currency;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Contracts\Shop\Currency as CurrencyInterface;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Currency extends BaseModel implements CurrencyInterface
{
    use HasEnabledStatus;

    protected $tableKey = 'Currencies';

    protected $fillable = [
        'code',
        'name',
        'symbol',
        'precision',
        'thousand_separator',
        'decimal_separator',
        'swap_currency_symbol',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Максимальное значение цены для текущей валюты
     *
     * @return string
     */
    public function getMaxPriceValue() {
        return 2147483647 / pow(10 , $this->getPrecision());
    }

    public function getSymbol()
    {
        return $this->symbol;
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

    public function formatPrice($priceValue): string
    {
        $formattedPrice = number_format(
            $priceValue,
            $this->getPrecision(),
            $this->getDecimalSeparator(),
            $this->getThousandSeparator()
        );

        $formattedPrice = str_replace(
            '.' . str_pad('', $this->getPrecision(), '0'),
            '',
            $formattedPrice
        );

        $symbol = $this->getSymbol();

        if ($this->isSymbolAfterPrice()) {
            $formattedPrice = "$formattedPrice $symbol";
        }
        else {
            $formattedPrice = "$symbol $formattedPrice";
        }

        return $formattedPrice;
    }
}