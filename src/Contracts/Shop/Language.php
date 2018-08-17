<?php

namespace MosseboShopCore\Contracts\Shop;

interface Language
{
    public function getDefaultCurrencyCode(): ?string;
}