<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Currencies;

trait HasCurrency
{
    public function getCurrentCurrencyCode()
    {
        $currencyCode = $this->getCurrentLanguageDefaultCurrencyCode();

        if (! is_null($currencyCode)) {
            return $currencyCode;
        }

        return Currencies::first()->code;
    }

    public function getCurrentLanguageDefaultCurrencyCode()
    {
        if (!$this->hasLanguage()) {
            return;
        }

        $language = $this->getCurrentLanguage();

        return $language->getDefaultCurrencyCode();
    }
}
