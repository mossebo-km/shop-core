<?php

namespace MosseboShopCore\Shop\Shop\Traits;

trait HasLanguage
{
    public function getDefaultLanguage()
    {
        return \Languages::default();
    }

    public function getCurrentLanguage()
    {
        $locale = App::getLocale();

        if ($locale) {
            $language = \Languages::where('code', $locale)->first();
        }

        if (empty($language)) {
            return $this->getDefaultLanguage();
        }

        return $language;
    }
}
