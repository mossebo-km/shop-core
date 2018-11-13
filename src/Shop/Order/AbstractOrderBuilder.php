<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Order\Order as OrderInterface;
use MosseboShopCore\Contracts\Shop\Order\OrderBuilder as OrderBuilderInterface;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Delivery;
use MosseboShopCore\Contracts\Shop\Payment;

abstract class AbstractOrderBuilder implements OrderBuilderInterface
{
    public function getOrder(): OrderInterface
    {
        $order = app()->make(OrderInterface::class);

        $order->setCart($this->getCart());
        $order->setCustomer($this->getCustomer());
        $order->setDelivery($this->getDelivery());
        $order->setPayment($this->getPayment());

        return $order;
    }

    protected function getCart(): ?Cart
    {

    }

    protected function getCustomer(): ?Customer
    {

    }

    protected function getDelivery(): ?Delivery
    {

    }

    protected function getPayment(): ?Payment
    {

    }
}