<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class ProductExpensive extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        $products = $cart->getProducts();
        $minPrice = $this->getParam('price');

        foreach ($products as $product) {
            $price = $product->getPrice();

            if ($price > $minPrice) {
                return true;
            }
        }

        return false;
    }
}