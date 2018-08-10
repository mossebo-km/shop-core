<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;

interface Condition
{
    public function check(Cart $cart): bool;

    public function apply(Cart & $cart): void;
}