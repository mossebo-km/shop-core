<?php

namespace MosseboShopCore\Models\Shop\Interior;

use MosseboShopCore\Models\Base\BaseModel;

abstract class InteriorI18n extends BaseModel
{
    protected $tableKey = 'InteriorsI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'interior_id',
        'language_code',
        'title',
    ];

    public $timestamps = false;
}
