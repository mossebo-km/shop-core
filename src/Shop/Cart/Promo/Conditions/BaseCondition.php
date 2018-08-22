<?php

namespace MosseboShopCore\Shop\Cart\Promo\Conditions;

use MosseboShopCore\Contracts\Models\Shop\Promo\PromoCondition as PromoConditionResourceInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Support\Traits\HasResource;

abstract class BaseCondition
{
    use HasResource;

    protected $params = null;

    public function __construct(PromoConditionResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    public function getParams()
    {
        if (is_null($this->params)) {
            $this->params = json_decode($this->resource->params, true);
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