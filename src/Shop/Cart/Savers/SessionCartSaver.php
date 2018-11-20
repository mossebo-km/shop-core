<?php

namespace MosseboShopCore\Shop\Cart\Savers;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use Session;

class SessionCartSaver extends AbstractCartSaver
{
    protected $storeKey = 'cart';

    public function save()
    {
        if ($this->getCart()->isEmpty()) {
            Session::forget($this->storeKey);

            return;
        }

        $data = [];

        $this->prepareProducts($data);
        $this->preparePromo($data);
        $this->prepareCurrencyCode($data);
        $this->preparePriceTypeId($data);
        $this->prepareTimestamps($data);

        // todo: доделать, или убрать скидки из корзины

        Session::put($this->storeKey, $data);
    }

    public function setStoreKey($key)
    {
        $this->storeKey = $key;
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
