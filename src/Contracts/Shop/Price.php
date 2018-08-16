<?php

namespace MosseboShopCore\Contracts\Shop;

interface Price
{
    public function setValue($value): void;
    public function getValue(): integer;
    public function setCurrencyCode($currencyCode): void;
    public function getCurrencyCode(): ?string;
    public function priceIsComparable(Price $price): bool;
    public function plus(Price $price): Price;
    public function minus(Price $price): Price;
    public function getCurrency(): ?Currency;

    public function getFormatted(): ?string;
    public static function formatPrice($value, $currencyCode): ?string;
}