<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class FirstOrder extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        if (! $cart->hasUser()) {
            return true;
        }

        return $cart->getUser()->ordersCount() === 0;
    }
}