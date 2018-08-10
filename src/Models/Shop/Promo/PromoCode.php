<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Order\OrderProduct;

abstract class PromoCode extends BaseModel
{
    protected $tableIdentif = 'PromoCodes';
    protected $relationFieldName = 'promo_code_id';
}
