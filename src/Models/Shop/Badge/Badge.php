<?php

namespace MosseboShopCore\Models\Shop\Badge;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Badge extends BaseModelI18n
{
    protected $tableIdentif = 'Badges';
    protected $relationFieldName = 'badge_type_id';
}
