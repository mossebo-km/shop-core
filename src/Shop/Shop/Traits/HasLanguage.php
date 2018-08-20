<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Languages;

trait HasLanguage
{
    protected $language = null;

    public function getCurrentLanguage()
    {
        if (is_null($this->language)) {
            $locale = app()->getLocale();

            if ($locale) {
                $this->language = Languages::where('code', $locale)->first();
            }

            if (empty($this->language)) {
                $this->language = $this->getDefaultLanguage();
            }
        }

        return $this->language;
    }

    public function getDefaultLanguage()
    {
        return Languages::default();
    }
}
