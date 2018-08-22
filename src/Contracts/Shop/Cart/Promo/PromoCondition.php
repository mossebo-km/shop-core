<?php

namespace MosseboShopCore\Contracts\Shop\Cart\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;

interface PromoCondition
{
    public function check(Cart $cart): bool;
    public function getParams();
    public function getParam($key);
    public function apply(Cart & $cart): void;
}