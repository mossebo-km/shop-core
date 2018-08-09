<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Order\Order;

class MinSumm extends BaseCondition implements ConditionInterface
{
    public function check(Order $order): bool
    {
        return ! ($order->getAmount() < $this->getParam('summ'));
    }
}