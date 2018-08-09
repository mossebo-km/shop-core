<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Order\Order;

class ProductsRelation extends BaseCondition implements ConditionInterface
{
    public function check(Order $order): bool
    {
        $productIds = array_column($order->getProducts()->toArray(), 'id');

        return 0 === count(
            array_diff($productIds, $this->getParam('relations'))
        );
    }

    public function apply(Order & $order): void
    {

    }
}