<?php

namespace MosseboShopCore\Models\Shop\Supplier;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Supplier extends BaseModel
{
    protected $tableKey = 'Suppliers';
    protected $relationFieldName = 'supplier_id';

    protected $fillable = [
        'name',
        'description',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
