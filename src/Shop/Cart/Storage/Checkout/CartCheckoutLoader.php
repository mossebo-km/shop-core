<?php

namespace MosseboShopCore\Shop\Cart\Storage\Session;

use Illuminate\Session\SessionManager;
use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use MosseboShopCore\Contracts\Shop\Cart\CartLoader;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\User;
use MosseboShopCore\Shop\Cart\CartProductData;


use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;

class CartCheckoutLoader implements CartLoader
{
    protected $cartData = null;

    public function __construct($data)
    {
        $this->cartData = $data;
    }

    public function getCart(): CartInterface
    {
        return app()->makeWith(CartInterface::class, $this->getCartContent());
    }

    public function getCartContent()
    {
        return [
            'user'         => $this->getUser(),
            'products'     => $this->getProducts(),
            'currencyCode' => $this->getCurrencyCode(),
            'promoCode'    => $this->getPromoCode(),
            'createdAt'    => time(),
            'updatedAt'    => time(),
        ];
    }

    protected function getCartData($key = null)
    {
        if (is_null($key)) {
            return $this->cartData;
        }

        if (isset($this->cartData[$key])) {
            return $this->cartData[$key];
        }

        return null;
    }

    public function __call($methodName, $arguments = null)
    {
        $key = str_replace('get', '', $methodName);
        $key = lcfirst($key);

        return $this->getCartData($key);
    }

    public function getUser(): ?User
    {
        return Auth::user();
    }

    public function getProducts(): Collection
    {
        $products = new Collection;

        foreach ($this->getCartData('products') as $productKey => $quantity) {
            $product = app()->make(CartProduct::class);

            $product->initByKey($productKey, $quantity);

            $products->push($product);
        }

        return $products;
    }

    public function getCurrencyCode()
    {
        return $this->getCartData('currencyCode');
    }

    protected function getPromoCode()
    {
        $promoCodeName = $this->getCartData('promoCode');

        if (is_null($promoCodeName)) {
            return null;
        }

        return app()->makeWith(PromoCode::class, [
            'codeName' => $promoCodeName
        ]);
    }
}

