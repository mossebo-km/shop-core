<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Order\OrderBuilder;

class OrderFactory
{
    public static function build(OrderBuilder $orderBuilder): Order
    {
        return $orderBuilder->getOrder();
    }
}