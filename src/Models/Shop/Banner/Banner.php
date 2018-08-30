<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Banner extends BaseModelI18n
{
    protected $tableIdentif = 'Banners';
    protected $relationFieldName = 'banner_id';
}
