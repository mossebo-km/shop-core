<?php

namespace MosseboShopCore\Shop\Order\Builders;

use Shop;
use MosseboShopCore\Shop\Cart\Builders\ModelCartLoader;
use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;
use MosseboShopCore\Contracts\Shop\Payment\Payment as PaymentInterface;

class ModelOrderBuilder extends AbstractOrderBuilder
{
    protected $orderData = null;

    public function __construct($data)
    {
        $this->orderData = $data;
    }

    protected function getCart(): ?Cart
    {
        return Shop::makeCart(ModelCartLoader::class, $this->orderData);
    }

    protected function getCustomer(): ?Customer
    {
        return $this->orderData->user;
    }

    protected function getShipping(): ?Shipping
    {
        $shipping = Shop::make(CustomerInterface::class);

        $shipping->fill($this->orderData);

        return $shipping;
    }

    protected function getPayment(): ?Payment
    {
        return Shop::make(PaymentInterface::class);
    }

    protected function getComment(): ?string
    {
        return $this->orderData->comment;
    }
}