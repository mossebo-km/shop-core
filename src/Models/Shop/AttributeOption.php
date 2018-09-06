<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class AttributeOption extends BaseModelI18n
{
    use HasEnabledStatus;

    protected $tableIdentif = 'AttributeOptions';
    protected $relationFieldName = 'option_id';
}