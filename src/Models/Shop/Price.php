<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Price extends BaseModel
{
    protected $tableIdentif = 'Prices';

    public function getCurrency()
    {
        return \Currencies::where('code', $this->currency_code)->first();
    }

    /**
     * Получение форматированной (побитой на разряды, с символом валюты) цены.
     *
     * @return mixed|string
     */
    public function getFormatted()
    {
        extract($this->getCurrency()->toArray(), EXTR_OVERWRITE);

        $price = number_format(
            $this->getValue(),
            $precision,
            $decimal_separator,
            $thousand_separator
        );

        $price = str_replace(('.' . str_pad('', $precision, '0')), '', $price);

        if ($swap_currency_symbol) {
            $price = "$price $symbol";
        }
        else {
            $price = "$symbol $price";
        }

        return $price;
    }

    /**
     * Возвращает цену с учетом количества знаков после запятой.
     *
     * @return float|int
     */
    public function getValue()
    {
        return $this->value / $this->getDivider();
    }

    /**
     * Получение значения, на которое нужно разделить значение из базы, чтобы получить верный результат.
     *
     * @return float|int
     */
    public function getDivider()
    {
        return pow(10, $this->getCurrency()['precision']);
    }
}