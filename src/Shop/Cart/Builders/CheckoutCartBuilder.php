<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;

class CheckoutCartBuilder extends AbstractCartBuilder
{
    protected $cartData = null;

    public function __construct($data)
    {
        $this->cartData = $data;
    }

    protected function getCustomer(): ?Customer
    {
        return Auth::user();
    }

    protected function getProducts(): Collection
    {
        $products = new Collection;

        foreach ($this->getCartData('cart.products') as $productKey => $quantity) {
            $product = Shop::make(CartProductInterface::class, [
                'productId' => $productKey,
                'quantity' => $quantity
            ]);

            $product->setBasePriceTypeId($this->getPriceTypeId());
            $product->setCurrencyCode($this->getCurrencyCode());
            $product->setAddedAtTimestamp();
            $product->setUpdatedAtTimestamp();

            $products->push($product);
        }

        return $products;
    }

    protected function getCurrencyCode(): ?string
    {
        return $this->getCartData('currencyCode') ?: Shop::getCurrentCurrencyCode();
    }

    protected function getPromoCode(): ?PromoCodeInterface
    {
        $promoCodeName = $this->getCartData('cart.promo_code');

        if (is_null($promoCodeName)) {
            return null;
        }

        return Shop::make(PromoCodeInterface::class, [
            'codeName' => $promoCodeName
        ]);
    }
}

