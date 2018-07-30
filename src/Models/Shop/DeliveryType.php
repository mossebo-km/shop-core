<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class DeliveryType extends BaseModelI18n
{
    protected $tableIdentif = 'DeliveryTypes';
    protected $relationFieldName = 'delivery_type_id';
}