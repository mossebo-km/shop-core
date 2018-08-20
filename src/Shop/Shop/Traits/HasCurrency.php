<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Currencies;

trait HasCurrency
{
    protected function getCurrentCurrencyCode()
    {
        $currencyCode = $this->getCurrentLanguageDefaultCurrencyCode();

        if (! is_null($currencyCode)) {
            return $currencyCode;
        }

        return Currencies::first()->code;
    }

    protected function getCurrentLanguageDefaultCurrencyCode()
    {
        if (!$this->hasLanguage()) {
            return;
        }

        $language = $this->getCurrentLanguage();

        return $language->getDefaultCurrencyCode();
    }
}
