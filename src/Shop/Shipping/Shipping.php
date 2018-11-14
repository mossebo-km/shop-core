<?php

namespace MosseboShopCore\Shop\Shipping;

use MosseboShopCore\Contracts\Shop\Shipping\Shipping as ShippingInterface;
use MosseboShopCore\Support\Traits\HasAttributes;

class Shipping implements ShippingInterface
{
    use HasAttributes;

    public function getId()
    {
        return 1;
    }
}