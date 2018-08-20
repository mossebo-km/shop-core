<?php

namespace MosseboShopCore\Shop\Shop\Traits;

use Languages;

trait HasLanguage
{
    public function getDefaultLanguage()
    {
        return Languages::default();
    }

    public function getCurrentLanguage()
    {
        $locale = app()->getLocale();

        if ($locale) {
            $language = Languages::where('code', $locale)->first();
        }

        if (empty($language)) {
            return $this->getDefaultLanguage();
        }

        return $language;
    }
}
