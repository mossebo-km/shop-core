<?php

namespace MosseboShopCore\Shop\Cart;


class CartProxy
{
    protected $cart;
    protected $saver;

    public function __construct($cartClass, Loader $loader, Saver $saver)
    {

    }

    public function add($productKey, $quantity = null)
    {
        $this->addProductToCart($productKey, $quantity);

        $this->save();
    }

    public function set($productKey, $quantity = null)
    {
        $this->cart->setProductByKey($productKey, $quantity);
    }

    public function setMany($items)
    {

    }

    protected function addProductToCart($productKey, $quantity = null)
    {
        $this->cart->addProductByKey($productKey, $quantity);
    }

    public function __call($methodName, $arguments)
    {
        return app()->call([$this->cart, $methodName], $arguments);
    }

    public function save()
    {
        $this->saver->save($this->cart);
    }
}