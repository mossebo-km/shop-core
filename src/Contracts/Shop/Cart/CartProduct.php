<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Price;

interface CartProduct
{
    public function setPromoPrice();
    public function getPrice(): Price;
}