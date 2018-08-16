<?php

namespace MosseboShopCore\Support\Traits\Models\Shop;

use MosseboShopCore\Contracts\Shop\Currency;

trait Price
{
    public function getCurrency(): Currency
    {
        return \Currencies::where('code', $this->getAttributeValue($this->getCurrencyCodeAttributeKey()))
            ->first();
    }

    protected function getCurrencyCodeAttributeKey()
    {
        return 'currency_code';
    }
}