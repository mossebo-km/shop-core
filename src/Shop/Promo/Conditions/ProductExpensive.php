<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\Condition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Order\Order;

class ProductExpensive extends BaseCondition implements ConditionInterface
{
    public function check(Order $order): bool
    {
        $products = $order->getProducts();
        $minPrice = $this->getParam('price');

        foreach ($products as $product) {
            $price = $product->getPrice();

            if ($price > $minPrice) {
                return true;
            }
        }

        return false;
    }
}