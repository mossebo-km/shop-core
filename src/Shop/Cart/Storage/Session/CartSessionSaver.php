<?php

namespace MosseboShopCore\Shop\Cart\Storage\Session;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use MosseboShopCore\Shop\Cart\Cart;
use MosseboShopCore\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Cart\CartSaver;

class CartSessionSaver extends CartSessionConnector implements CartSaver
{
    protected $cart = null;

    public function save(Cart $cart)
    {
        $this->cart = $cart;

        $data = [];

        $this->setProductsToSave($data);
        $this->setPromoToSave($data);
        $this->setCurrencyCodeToSave($data);
        $this->setTimestamps($data);

        // todo: доделать, или убрать скидки из корзины

        $this->put('cart', $data);
    }

    protected function setProductsToSave(& $data)
    {
        $data['products'] = $this->cart->getProducts()->reduce(function ($carry, CartProduct $product) {
            if (! $product->isExist()) {
                return;
            }

            $carry[] = $product->toStore();
        }, []);
    }

    protected function setPromoToSave(& $data)
    {
        $promoCode = $this->cart->getPromoCode();

        if (! is_null($promoCode)) {
            $data['promoCode'] = $promoCode->getName();
        }
    }

    protected function setCurrencyCodeToSave(& $data)
    {
        $data['currencyCode'] = $this->cart->getCurrencyCode();
    }

    protected function setTimestamps(& $data)
    {
        $data['createdAt'] = $this->cart->getCreatedAt();
        $data['updatedAt'] = $this->cart->getUpdatedAt();
    }
}