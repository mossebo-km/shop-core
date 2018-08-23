<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModelI18n;
use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Order\OrderProduct;

abstract class PromoCode extends BaseModelI18n
{
    protected $tableIdentif = 'PromoCodes';
    protected $relationFieldName = 'promo_code_id';
}
