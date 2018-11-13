<?php

namespace MosseboShopCore\Contracts\Shop\Shipping;

interface Shipping
{
    public function getId();
    public function getAttribute($key);
}