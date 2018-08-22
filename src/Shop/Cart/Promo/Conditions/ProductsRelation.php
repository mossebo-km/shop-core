<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

class ProductsRelation extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        $productIds = array_column($cart->getProducts()->toArray(), 'id');

        return 0 === count(
            array_diff($productIds, $this->getParam('relations'))
        );
    }
}