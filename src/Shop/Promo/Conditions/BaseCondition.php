<?php

namespace MosseboShopCore\Shop\Promo\Conditions;
use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode;

class BaseCondition
{
    protected $code;
    protected $params;

    public function __construct(PromoCode $code, array $params = [])
    {
        $this->code = $code;
        $this->params = $params;
    }

    public function getParam($key)
    {
        return $this->params[$key];
    }

    public function apply(Order & $order): void
    {
    }
}