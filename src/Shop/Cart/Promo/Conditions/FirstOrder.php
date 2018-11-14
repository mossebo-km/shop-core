<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class FirstOrder extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        if (! $cart->hasCustomer()) {
            return true;
        }

        return $cart->getCustomer()->ordersCount() === 0;
    }
}