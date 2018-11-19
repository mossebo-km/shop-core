<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartSaver
{
    public function __construct(Cart $cart);
    public function save();
}