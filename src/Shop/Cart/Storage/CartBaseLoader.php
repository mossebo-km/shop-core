<?php

namespace MosseboShopCore\Shop\Cart\Storage;

use Shop;
use Illuminate\Support\Collection;
use MosseboShopCore\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartLoader;

abstract class CartBaseLoader implements CartLoader
{
    protected $promoCodeClass = null;
    protected $cartProductClass = null;

    public function getCart(): CartInterface
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