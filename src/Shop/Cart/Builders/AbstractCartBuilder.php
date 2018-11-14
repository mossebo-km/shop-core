<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartBuilder as CartBuilderInterface;

use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;
use Shop;
use Auth;

abstract class AbstractCartBuilder implements CartBuilderInterface
{
    protected $cartData = null;

    public function getCart(): CartInterface
    {
        $cart = Shop::make(CartInterface::class);

        $cart->setCustomer($this->getCustomer());
        $cart->setPriceTypeId($this->getPriceTypeId());
        $cart->setCurrencyCode($this->getCurrencyCode());
        $cart->setProducts($this->getProducts());

        if ($promoCode = $this->getPromoCode()) {
            $cart->setPromoCode($promoCode);
        }

        $cart->setCreatedAt($this->getCreatedAt());
        $cart->setUpdatedAt($this->getUpdatedAt());

        return $cart;
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

    protected function getCustomer(): ?CustomerInterface
    {
        return Auth::user();
    }

    protected function getCurrencyCode(): ?string
    {

    }

    protected function getProducts(): Collection
    {

    }

    protected function getPromoCode(): ?PromoCodeInterface
    {

    }

    protected function getPriceTypeId(): int
    {
        if ($customer = $this->getCustomer()) {
            return $customer->getPriceTypeId();
        }

        return Shop::getDefaultPriceTypeId();
    }

    protected function getCreatedAt()
    {
        return time();
    }

    protected function getUpdatedAt()
    {
        return time();
    }
}