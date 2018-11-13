<?php

namespace MosseboShopCore\Contracts\Shop\Order;

interface OrderBuilder
{
    public function getOrder(): Order;
}