<?php

namespace MosseboShopCore\Contracts\Shop;

interface Currency
{
    public function getMaxPriceValue();
    public function getPrecision();
    public function getDecimalSeparator();
    public function getThousandSeparator();
    public function isSymbolFirst(): bool;

    public function formatPrice($price): string;
}