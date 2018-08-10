<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class MinSumm extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        return ! ($cart->getAmount() < $this->getParam('summ'));
    }
}