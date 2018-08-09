<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Order\Order;

interface Condition
{
    public function check(Order $order): bool;

    public function apply(Order & $order): void;
}