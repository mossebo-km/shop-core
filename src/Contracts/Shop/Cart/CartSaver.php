<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartSaver
{
    public function save(Cart $cart);
}