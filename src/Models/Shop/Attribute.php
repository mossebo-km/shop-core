<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Attribute extends BaseModelI18n
{
    use HasEnabledStatus;

    protected $tableIdentif = 'Attributes';
    protected $relationFieldName = 'attribute_id';
}
