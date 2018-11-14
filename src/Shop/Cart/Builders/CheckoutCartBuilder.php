<?php

namespace MosseboShopCore\Shop\Cart\Types\Checkout;

use MosseboShopCore\Shop\Cart\Builders\AbstractCartBuilder;
use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
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
            $products->push(Shop::makeCartProduct($productKey, null, $quantity, function (CartProduct $product) {
                $product->setBasePriceTypeId($this->getPriceTypeId());
                $product->setCurrencyCode($this->getCurrencyCode());
            }));
        }

        return $products;
    }

    protected function getCurrencyCode(): ?string
    {
        return $this->getCartData('currencyCode');
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

