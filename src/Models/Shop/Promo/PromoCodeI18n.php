<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PromoCodeI18n extends BaseModel
{
    protected $tableKey = 'PromoCodesI18n';

    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'promo_code_id',
        'language_code',
        'title',
        'description',
    ];
}
