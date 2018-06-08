<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Support\Traits\Models\NestedTrait;

abstract class Category extends BaseModelI18n
{
    use NestedTrait;

    protected $tableIdentif = 'Categories';
    protected $relationFieldName = 'category_id';
}