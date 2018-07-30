<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class PayType extends BaseModelI18n
{
    protected $tableIdentif = 'PayTypes';
    protected $relationFieldName = 'pay_type_id';
}