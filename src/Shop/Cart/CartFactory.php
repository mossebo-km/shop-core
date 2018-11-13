<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\CartBuilder;

class CartFactory
{
    public static function build(CartBuilder $cartBuilder): Cart
    {
        return $cartBuilder->getCart();
    }
}