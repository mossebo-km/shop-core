<?php

namespace MosseboShopCore\Support\Traits\Models\Shop;

use MosseboShopCore\Contracts\Shop\Currency;
use Shop;

/**
 * Для моделей, которые хранят цену в integer.
 *
 * Trait IntegerPrice
 * @package App\Support\Traits\Models\Shop
 */

trait StorePriceValueAsInteger
{
    use Price;

    /**
     * Название стандартного аттрибута цены
     *
     * @return string
     */
    protected function getPriceAttributeKey()
    {
        if (count($this->priceAttributeKeys) > 1) {
            throw new \Exception('Невозможно определить название необходимого аттрибута цены');
        }

        return $this->priceAttributeKeys[0];
    }

    public function getCurrency(): Currency
    {
        return Shop::getCurrency($this->currency_code);
    }

    /**
     * Получение значения, на которое нужно разделить значение из базы, чтобы получить верный результат.
     *
     * @return float|int
     */
    public function getIntegerPriceDivider()
    {
        // Если нет валюты - все ломается.
        $currency = $this->getCurrency();

        return pow(10, $currency->getPrecision());
    }

    /**
     * Так как значение цены хранится в integer, надо добавить используемое в валюте количество знаков после запятой.
     *
     * @param $value
     * @return float|int
     */
    protected function integerPriceValueToStore($value)
    {
        return $value * $this->getIntegerPriceDivider();
    }

    protected function integerPriceValueFromStore($value)
    {
        return $value / $this->getIntegerPriceDivider();
    }

    protected function attributeKeyHasPriceIntegerValue($key)
    {
        return in_array($key, $this->priceAttributeKeys);
    }

    /**
     * Обходим возможности задать необработанное значение
     *
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        if ($this->attributeKeyHasPriceIntegerValue($key)) {
            $value = $this->integerPriceValueToStore($value);
        }

        parent::setAttribute($key, $value);
    }

    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if ($this->attributeKeyHasPriceIntegerValue($key)) {
            $value = $this->integerPriceValueFromStore($value);
        }

        return $value;
    }
}