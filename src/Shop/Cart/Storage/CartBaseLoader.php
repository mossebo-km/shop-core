<?php

namespace MosseboShopCore\Shop\Cart\Storage;

use Shop;
use Illuminate\Support\Collection;
use MosseboShopCore\Shop\Cart\Cart;

abstract class CartBaseLoader
{
    protected $promoCodeClass = null;
    protected $cartProductClass = null;

    public function init()
    {
        app()->makeWith(Cart::class, [
            'products'     => $this->getProducts(),
            'currencyCode' => $this->getCurrencyCode(),
            'promoCode'    => $this->getPromoCode(),
            'discounts'    => $this->getDiscounts()
        ]);
    }
}
