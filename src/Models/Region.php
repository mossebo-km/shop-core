<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\NestedTrait;

abstract class Region extends BaseModel
{
    use NestedTrait;

    protected $tableIdentif = 'Regions';
}
