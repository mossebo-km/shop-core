<?php

namespace MosseboShopCore\Shop\Cart\Savers;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\CartSaver;

abstract class AbstractCartSaver implements CartSaver
{
    protected $cart = null;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    protected function getCart(): Cart
    {
        return $this->cart;
    }
}