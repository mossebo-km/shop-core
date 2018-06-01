<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class Supplier extends BaseModel
{
    protected $tableIdentif = 'Suppliers';

    public function products()
    {
        return $this->hasMany(Products::class, 'supplier_id');
    }
}
