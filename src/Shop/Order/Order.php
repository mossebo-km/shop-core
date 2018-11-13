<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Delivery\Delivery;
use MosseboShopCore\Contracts\Shop\Payment\Payment;

class Order
{
    protected $cart     = null;
    protected $customer = null;
    protected $delivery = null;
    protected $payment  = null;

    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }










}