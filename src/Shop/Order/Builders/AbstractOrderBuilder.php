<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Order\Order as OrderInterface;
use MosseboShopCore\Contracts\Shop\Order\OrderBuilder as OrderBuilderInterface;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Shipping\Shipping;
use MosseboShopCore\Contracts\Shop\Payment\Payment;

abstract class AbstractOrderBuilder implements OrderBuilderInterface
{
    public function getOrder(): OrderInterface
    {
        $order = Shop::make(OrderInterface::class);

        $order->setCart($this->getCart());
        $order->setCustomer($this->getCustomer());
        $order->setShipping($this->getShipping());
        $order->setPayment($this->getPayment());
        $order->setComment($this->getComment());

        return $order;
    }

    protected function getCart(): ?Cart
    {

    }

    protected function getCustomer(): ?Customer
    {

    }

    protected function getShipping(): ?Shipping
    {

    }

    protected function getPayment(): ?Payment
    {

    }

    protected function getComment(): ?string
    {

    }
}