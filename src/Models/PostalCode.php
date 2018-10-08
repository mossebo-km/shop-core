<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PostalCode extends BaseModel
{
    protected $tableKey = 'PostalCodes';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'item_id',
        'item_type',
        'code',
    ];

    public $timestamps = false;

    public function item()
    {
        return $this->morphTo();
    }
}
