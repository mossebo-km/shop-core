<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Style extends BaseModelI18n
{
    protected $tableIdentif = 'Styles';
    protected $relationFieldName = 'style_id';
}