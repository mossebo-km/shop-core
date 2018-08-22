<?php

namespace MosseboShopCore\Contracts\Shop;

interface Price
{
    public function setValue($value): void;
    public function getValue(): float;
    public function setCurrencyCode($currencyCode): void;
    public function getCurrencyCode(): ?string;
    public function priceIsComparable(Price $price): bool;
    public function plus(Price $price): Price;
    public function minus(Price $price): Price;
    public function moreThan(Price $price): bool;
    public function equalOrMoreThan(Price $price): bool;
    public function lessThan(Price $price): bool;
    public function equalOrLessThan(Price $price): bool;
    public function equal(Price $price): bool;
    public function getCurrency(): ?Currency;

    public function getFormatted(): ?string;
    public static function formatPrice($value, $currencyCode): ?string;
}