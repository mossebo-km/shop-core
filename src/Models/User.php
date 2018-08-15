<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\Authenticatable;

abstract class User extends Authenticatable
{
    protected $relationFieldName = 'user_id';
}
