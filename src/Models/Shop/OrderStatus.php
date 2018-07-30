<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class OrderStatus extends BaseModelI18n
{
    protected $tableIdentif = 'OrderStatuses';
    protected $relationFieldName = 'order_status_id';
}