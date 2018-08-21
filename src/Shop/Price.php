<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Price as PriceInterface;
use MosseboShopCore\Contracts\Shop\Currency;

class Price implements PriceInterface
{
    protected $value = null;
    protected $currencyCode = null;

    public function __construct($value = null, $currencyCode = null)
    {
        $this->value = $value;
        $this->currencyCode = $currencyCode;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return is_null($this->value) ? 0 : $this->value;
    }

    public function setCurrencyCode($currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function priceIsComparable(PriceInterface $price): bool
    {
        if ($price->getCurrencyCode() !== $this->currencyCode) {
            return false;
        }

        if (! is_numeric($price->getValue())) {
            return false;
        }

        return true;
    }

    public function plus(PriceInterface $price): PriceInterface
    {
        if ($this->priceIsComparable($price)) {
            return new static(
                $this->value + $price->getValue(),
                $this->currencyCode
            );
        }

        // todo: Бросать ошибку, или возвращать null????
        throw new \Exception('Non-comparable price');
    }

    public function minus(PriceInterface $price): PriceInterface
    {
        if ($this->priceIsComparable($price)) {
            return new static(
                $this->value - $price->getValue(),
                $this->currencyCode
            );
        }

        // todo: Бросать ошибку, или возвращать null????
        throw new \Exception('Non-comparable price');
    }

    public function getCurrency(): ?Currency
    {
        return \Currencies::where('code', $this->currencyCode)->first();
    }

    /**
     * Получение форматированной (побитой на разряды, с символом валюты) цены.
     *
     * @return mixed|string
     */
    public function getFormatted(): ?string
    {
        $currency = $this->getCurrency();

        if (is_null($currency)) {
            return null;
        }

        return $currency->formatPrice($this->getValue());
    }

    public static function formatPrice($value, $currencyCode): ?string
    {
        return (new static($value, $currencyCode))->getFormatted();
    }
}