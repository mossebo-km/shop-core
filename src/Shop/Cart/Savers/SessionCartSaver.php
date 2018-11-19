<?php

namespace MosseboShopCore\Shop\Cart\Savers;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Shop\Cart\Traits\HasSession;

class SessionCartSaver extends AbstractCartSaver
{
    use HasSession;

    public function save()
    {
        if (! $this->cart->getProducts()->count()) {
            $this->forget('cart');

            return;
        }

        $data = [];

        $this->prepareProducts($data);
        $this->preparePromo($data);
        $this->prepareCurrencyCode($data);
        $this->preparePriceTypeId($data);
        $this->prepareTimestamps($data);

        // todo: доделать, или убрать скидки из корзины

        $this->put('cart', $data);
    }

    protected function prepareProducts(& $data)
    {
        $data['products'] = $this->getCart()->getProducts()->reduce(function ($carry, CartProduct $product) {
//            if (! $product->isExist()) {
//                return;
//            }

            $carry[] = $product->toStore();

            return $carry;
        }, []);
    }

    protected function preparePromo(& $data)
    {
        $promoCode = $this->getCart()->getPromoCode();

        if (! is_null($promoCode)) {
            $data['promoCode'] = $promoCode->getName();
        }
    }

    protected function preparePriceTypeId(& $data)
    {
        $data['priceTypeId'] = $this->getCart()->getPriceTypeId();
    }

    protected function prepareCurrencyCode(& $data)
    {
        $data['currencyCode'] = $this->getCart()->getCurrencyCode();
    }

    protected function prepareTimestamps(& $data)
    {
        $data['createdAt'] = $this->getCart()->getCreatedAt();
        $data['updatedAt'] = $this->getCart()->getUpdatedAt();
    }
}
