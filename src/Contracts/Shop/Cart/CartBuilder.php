<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartBuilder
{
    public function getCart(): Cart;
}