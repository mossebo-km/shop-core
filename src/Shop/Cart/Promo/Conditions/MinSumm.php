<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition as ConditionInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Price;

class MinSumm extends BaseCondition implements ConditionInterface
{
    public function check(Cart $cart): bool
    {
        $minPrice = app()->makeWith(Price::class, [
            'value' => $this->getParam('value'),
            'currencyCode' => $this->getParam('currency_code')
        ]);

        return $cart->getAmount()->equalOrMoreThan($minPrice);
    }
}