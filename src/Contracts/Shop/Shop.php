<?php

namespace MosseboShopCore\Contracts\Shop;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Customer;

interface Shop
{
    public function make($className, $data = null);
    public function makeCart($cartBuilderClassName, $data = null): Cart;
    public function makeOrder($orderBuilderClassName, $data = null): Order;

//    public function getCustomer(): ?Customer;
}