<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BannerPosition extends BaseModel
{
    protected $tableIdentif = 'BannerPositions';
    protected $relationFieldName = 'banner_position_id';
}
