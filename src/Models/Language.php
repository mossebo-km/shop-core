<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

use MosseboShopCore\Contracts\Shop\Language as LanguageInterface;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Language extends BaseModel implements LanguageInterface
{
    use HasEnabledStatus;

    protected $tableIdentif = 'Languages';

    public function getDefaultCurrencyCode(): ?string
    {
        return $this->currency_code;
    }
}
