<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Country extends BaseModel
{
    protected $tableKey = 'Countries';

    protected $fillable = [
        'code',
        'position',
        'language_code',
        'currency_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
