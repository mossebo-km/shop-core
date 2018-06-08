<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Room extends BaseModelI18n
{
    protected $tableIdentif = 'Rooms';
    protected $relationFieldName = 'room_id';
}