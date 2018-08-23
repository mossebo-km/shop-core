<?php

namespace MosseboShopCore\Models\Shop\Badge;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class BadgeType extends BaseModelI18n
{
    protected $tableIdentif = 'BadgeTypes';
    protected $relationFieldName = 'badge_type_id';
}
