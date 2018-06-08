<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class AttributeOption extends BaseModelI18n
{
    protected $tableIdentif = 'AttributeOptions';
    protected $relationFieldName = 'option_id';
}