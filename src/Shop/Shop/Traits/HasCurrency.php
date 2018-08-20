<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Currencies;

trait HasCurrency
{
    protected $currencyCode = null;

    public function getCurrentCurrencyCode()
    {
        if (is_null($this->currencyCode)) {
            $this->currencyCode = $this->getCurrentLanguageDefaultCurrencyCode();

            if (is_null($this->currencyCode)) {
                $this->currencyCode = Currencies::first()->code;
            }
        }

        return $this->currencyCode;
    }

    protected function getCurrentLanguageDefaultCurrencyCode()
    {
        if (!$this->hasLanguage()) {
            return null;
        }

        $language = $this->getCurrentLanguage();

        return $language->getDefaultCurrencyCode();
    }
}
