<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Cart\CartLoader;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Customer;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;

class CheckoutCartBuilder implements CartLoader
{
    protected $cartData = null;
    protected $priceTypeId = null;

    public function __construct($data)
    {
        $this->cartData = $data;
    }

    public function getCart(): CartInterface
    {
        return Shop::make(CartInterface::class, $this->getCartContent());
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

        if (array_has($this->cartData, $key)) {
            return array_get($this->cartData, $key);
        }

        return null;
    }

    public function __call($methodName, $arguments = null)
    {
        $key = str_replace('get', '', $methodName);
        $key = lcfirst($key);

        return $this->getCartData($key);
    }

    public function getUser(): ?Customer
    {
        return Auth::user();
    }

    protected function getPriceTypeId()
    {
        if (is_null($this->priceTypeId)) {
            if ($user = $this->getUser()) {
                $this->priceTypeId = $user->getPriceTypeId();
            }
            else {
                $this->priceTypeId = Shop::getDefaultPriceTypeId();
            }
        }

        return $this->priceTypeId;
    }

    public function getProducts(): Collection
    {
        $products = new Collection;

        foreach ($this->getCartData('cart.products') as $productKey => $quantity) {
            $product = Shop::make(CartProduct::class);

            $product->initByKey(
                $productKey,
                $quantity,
                $this->getPriceTypeId(),
                null,
                $this->getCurrencyCode());

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
        $promoCodeName = $this->getCartData('cart.promo_code');

        if (is_null($promoCodeName)) {
            return null;
        }

        return Shop::make(PromoCode::class, [
            'codeName' => $promoCodeName
        ]);
    }
}

