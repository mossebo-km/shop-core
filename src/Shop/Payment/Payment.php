<?php

namespace MosseboShopCore\Shop\Shipping;

use MosseboShopCore\Contracts\Shop\Payment\Payment as PaymentInterface;
use MosseboShopCore\Support\Traits\HasAttributes;

class Payment implements PaymentInterface
{
    use HasAttributes;

    public function getId()
    {
        return $this->getAttribute('id');
    }
}