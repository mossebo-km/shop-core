<?php

namespace MosseboShopCore\Models\Shop\Interior;

use MosseboShopCore\Models\Base\BaseModel;

abstract class InteriorStyle extends BaseModel
{
    protected $tableKey = 'InteriorStyles';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'interior_id',
        'style_id',
    ];

    public $timestamps = false;
}
