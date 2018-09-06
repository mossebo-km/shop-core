<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Settings extends BaseModel
{
    protected $tableKey = 'Settings';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'key',
        'value',
        'position',
    ];

    public $timestamps = false;
}
