<?php

namespace MosseboShopCore\Shop\Cart;

class CartProxy
{
    protected $cart;
    protected $saver;

    public function add($productKey, $quantity = null)
    {
        $this->addProduct($productKey, $quantity);

        $this->save();
    }

    public function set($productKey, $quantity = null)
    {
        $this->cart->setProduct($productKey, $quantity);

        $this->save();
    }

    public function setMany($items)
    {
        foreach ($items as $item) {
            $this->setProduct($item['key'], $item['qty']);
        }

        $this->save();
    }

    protected function addProduct($productKey, $quantity = null)
    {
        $this->cart->addProductByKey($productKey, $quantity);
    }

    protected function setProduct($productKey, $quantity = null)
    {
        $this->cart->setProductByKey($productKey, $quantity);
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