<?php

namespace MosseboShopCore\Contracts\Shop;

interface Currency
{
    public function getMaxPriceValue();
    public function getSymbol();
    public function getPrecision();
    public function getDecimalSeparator();
    public function getThousandSeparator();
    public function isSymbolAfterPrice(): bool;

    public function formatPrice($price): string;
}