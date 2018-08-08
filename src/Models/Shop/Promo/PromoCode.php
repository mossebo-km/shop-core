<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class PromoCode extends BaseModel
{
    protected $tableIdentif = 'PromoCodes';
    protected $relationFieldName = 'promo_code_id';
}
