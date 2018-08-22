<?php

namespace MosseboShopCore\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\CartSaver;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;

class CartProxy
{
    protected $cart;
    protected $saver;

    public function __construct(Cart $cart, CartSaver $saver)
    {
        $this->cart = $cart;
        $this->saver = $saver;
    }

    public function get()
    {
        return $this->cart;
    }

    public function add($productKey, $quantity = null)
    {
        $this->addProduct($productKey, $quantity);

        $this->save();

        return $this;
    }

    public function set($productKey, $quantity = null)
    {
        $this->cart->setProduct($productKey, $quantity);

        $this->save();

        return $this;
    }

    public function setMany($items)
    {
        foreach ($items as $item) {
            $this->setProduct($item['key'], $item['qty']);
        }

        $this->save();

        return $this;
    }

    protected function addProduct($productKey, $quantity = null)
    {
        $this->cart->addProductByKey($productKey, $quantity);
    }

    protected function setProduct($productKey, $quantity = null)
    {
        $this->cart->setProductByKey($productKey, $quantity);
    }

    public function setPromoCode(PromoCode $promoCode)
    {
        $this->cart->setPromoCode($promoCode);

        return $this->save();
    }

    public function __call($methodName, $arguments)
    {
        return app()->call([$this->cart, $methodName], $arguments);
    }

    public function clear()
    {
        $this->cart->clear();
        $this->save();

        return $this;
    }

    public function save()
    {
        $this->saver->save($this->cart);

        return $this;
    }
}
