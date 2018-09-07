<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

use MosseboShopCore\Contracts\Shop\Language as LanguageInterface;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Language extends BaseModel implements LanguageInterface
{
    use HasEnabledStatus;

    protected $tableKey = 'Languages';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'name',
        'image',
        'currency_code',
        'enabled',
        'position',
        'default',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getDefaultCurrencyCode(): ?string
    {
        return $this->currency_code;
    }
}
