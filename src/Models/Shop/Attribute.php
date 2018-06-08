<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Attribute extends BaseModelI18n
{
    protected $tableIdentif = 'Attributes';
    protected $relationFieldName = 'attribute_id';
}
