<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Models\Shop\Currency;

class Language extends BaseModel
{
    protected $tableIdentif = 'Languages';

    public function currency()
    {
        return $this->hasOne(Currency::class, 'code', 'currency_code');
    }
}
