<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Order\Order;

class ProductsQuantity extends BaseCondition implements ConditionInterface
{
    public function check(Order $order): bool
    {
        return $order->getProductsQuantity() >= $this->getParam('quantity');
    }
}