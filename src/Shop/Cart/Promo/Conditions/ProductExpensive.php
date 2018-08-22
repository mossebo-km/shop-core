<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Price;

class ProductExpensive extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        $products = $cart->getProducts();

        $currencyCode = $this->getParam('currency_code');

        $minPrice = app()->makeWith(Price::class, [
            'value' => $this->getParam('value'),
            'currencyCode' => $currencyCode
        ]);

        foreach ($products as $product) {
            $price = $product->getBasePrice(
                $cart->getPriceTypeId(),
                $currencyCode
            );

            if ($minPrice->lessOrEqualThan($price)) {
                return true;
            }
        }

        return false;
    }
}