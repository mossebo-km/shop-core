<?php

namespace MosseboShopCore\Shop\Cart\Storage;

use Shop;
use Illuminate\Support\Collection;
use MosseboShopCore\Shop\Cart\Cart;

abstract class CartBaseLoader
{
    protected $promoCodeClass = null;
    protected $cartProductClass = null;

    public function getCart()
    {
        return app()->makeWith(Cart::class, $this->getCartContent());
    }

    public function getCartContent()
    {
        return [
            'products'     => $this->getProducts(),
            'currencyCode' => $this->getCurrencyCode(),
            'promoCode'    => $this->getPromoCode(),
            'discounts'    => $this->getDiscounts(),
            'createdAt'    => $this->getCreatedAt(),
            'updatedAt'    => $this->getUpdatedAt(),
        ];
    }
}