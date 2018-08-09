<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Order\Order;

class FirstOrder extends BaseCondition implements ConditionInterface
{
    public function check(Order $order): bool
    {
        if (! $order->hasUser()) {
            return true;
        }

        return $order->getUser()->ordersCount() === 0;
    }
}