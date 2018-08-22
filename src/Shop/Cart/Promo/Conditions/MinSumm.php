<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class MinSumm extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        return ! ($cart->getAmount() < $this->getParam('summ'));
    }
}