<?php

namespace MosseboShopCore\Shop\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class ProductsQuantity extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        return $cart->getProductsQuantity() >= $this->getParam('quantity');
    }
}