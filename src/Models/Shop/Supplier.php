<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class Supplier extends BaseModel
{
    protected $tableIdentif = 'Suppliers';
    protected $relationFieldName = 'supplier_id';
}
