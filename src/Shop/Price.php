<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Price as PriceInterface;
use MosseboShopCore\Contracts\Shop\Currency;
use Shop;

class Price implements PriceInterface
{
    protected $value = null;
    protected $currencyCode = null;

    public function __construct($value = null, $currencyCode = null)
    {
        $this->setValue($value);
        $this->setCurrencyCode($currencyCode);
    }

    public function setValue($value): void
    {
        if ($value == (int) $value) {
            $this->value = (int) $value;
        }
        else {
            $this->value = (float) $value;
        }
    }

    public function getValue()
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
        // todo: Бросать ошибку, или возвращать null????

        if ($price->getCurrencyCode() !== $this->currencyCode) {
            throw new \Exception('Non-comparable price');
        }

        if (! is_numeric($price->getValue())) {
            throw new \Exception('Non-comparable price');
        }

        return true;
    }

    public function plus(PriceInterface $price)
    {
        if ($this->priceIsComparable($price)) {
            $this->setValue(
                $this->value + $price->getValue()
            );
        }

        return $this;
    }

    public function minus(PriceInterface $price)
    {
        if ($this->priceIsComparable($price)) {
            $this->setValue(
                $this->value - $price->getValue()
            );
        }

        return $this;
    }

    public function moreThan(PriceInterface $price): bool
    {
        if ($this->priceIsComparable($price)) {
            return $this->getValue() > $price->getValue();
        }
    }

    public function equalOrMoreThan(PriceInterface $price): bool
    {
        if ($this->priceIsComparable($price)) {
            return $this->getValue() >= $price->getValue();
        }
    }

    public function lessThan(PriceInterface $price): bool
    {
        if ($this->priceIsComparable($price)) {
            return $this->getValue() < $price->getValue();
        }
    }

    public function equalOrLessThan(PriceInterface $price): bool
    {
        if ($this->priceIsComparable($price)) {
            return $this->getValue() <= $price->getValue();
        }
    }

    public function equal(PriceInterface $price): bool
    {
        if ($this->priceIsComparable($price)) {
            return $this->getValue() === $price->getValue();
        }
    }

    public function getCurrency(): ?Currency
    {
        return Shop::getCurrency($this->currencyCode);
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
