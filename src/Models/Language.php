<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

use MosseboShopCore\Contracts\Shop\Language as LanguageInterface;

abstract class Language extends BaseModel implements LanguageInterface
{
    protected $tableIdentif = 'Languages';

    public function getDefaultCurrencyCode(): ?string
    {
        return $this->currency_code;
    }
}
