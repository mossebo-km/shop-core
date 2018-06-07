<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class Supplier extends BaseModel
{
    protected $tableIdentif = 'Suppliers';
    protected $relationFieldName = 'supplier_id';

    public function products()
    {
        return $this->hasMany(Products::class, $this->relationFieldName);
    }
}
