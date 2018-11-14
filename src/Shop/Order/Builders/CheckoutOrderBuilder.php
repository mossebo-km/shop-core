<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Shipping\Shipping;
use MosseboShopCore\Contracts\Shop\Payment\Payment;
use MosseboShopCore\Shop\Cart\Builders\CheckoutCartBuilder;
use Shop;

class CheckoutOrderBuilder extends AbstractOrderBuilder
{
    protected $checkoutData = null;

    public function __construct($data)
    {
        $this->checkoutData = $data;
    }

    protected function getCart(): ?Cart
    {
        return Shop::makeCart(CheckoutCartBuilder::class, $this->checkoutData);
    }

    protected function getCustomer(): ?Customer
    {
        $customer = Shop::getCustomer();

        if (! $customer) {
            $customer = Shop::make(Customer::class);
        }

        if ($this->checkoutData['shipping']['data'] && is_array($this->checkoutData['shipping']['data'])) {
            $customer->fill($this->checkoutData['shipping']['data']);
        }

        return $customer;
    }

    protected function getShipping(): ?Shipping
    {
        $shipping = Shop::make(Shipping::class);

        if ($this->checkoutData['shipping']['data'] && is_array($this->checkoutData['shipping']['data'])) {
            $shipping->fill($this->checkoutData['shipping']['data']);
        }

        return $shipping;
    }

    protected function getPayment(): ?Payment
    {
        return Shop::make(Payment::class);
    }

    protected function getComment(): ?string
    {
        if (isset($this->checkoutData['shipping']['data']['comment'])) {
            return $this->checkoutData['shipping']['data']['comment'];
        }

        return '';
    }
}
