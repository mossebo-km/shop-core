<?php

namespace MosseboShopCore\Models\Shop\Banner;

use MosseboShopCore\Models\Base\BaseModel;

abstract class BannerPlace extends BaseModel
{
    protected $tableIdentif = 'BannerPlaces';
    protected $relationFieldName = 'place_id';
}
