<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Models\Shop\Promo\PromoCondition;
use MosseboShopCore\Contracts\Shop\Cart\Cart;

abstract class BaseCondition
{
    protected $condition;
    protected $params = null;

    public function __construct(PromoCondition $condition)
    {
        $this->condition = $condition;
    }

    public function getParams()
    {
        if (is_null($this->params)) {
            $this->params = json_decode($this->condition->params, true);
        }

        return $this->params;
    }

    public function getParam($key)
    {
        return $this->getParams()[$key];
    }

    public function apply(Cart & $cart): void
    {
    }
}