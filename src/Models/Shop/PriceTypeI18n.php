<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PriceTypeI18n extends BaseModel
{
    protected $tableKey = 'PriceTypesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'price_type_id',
        'language_code',
        'title',
        'description'
    ];

    public $timestamps = false;
}
