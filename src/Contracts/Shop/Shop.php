<?php

namespace MosseboShopCore\Contracts\Shop;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Order\Order;

interface Shop
{
    public function make($className, $data = null);
    public function makeCart($className, $data = null): Cart;
    public function makeOrder($className, $data = null): Order;
}