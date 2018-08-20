<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartLoader
{
    public function getCart(): Cart;
}