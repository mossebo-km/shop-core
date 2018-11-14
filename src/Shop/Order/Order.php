<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Order\Order as OrderInterface;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Shipping\Shipping;
use MosseboShopCore\Contracts\Shop\Payment\Payment;
use Shop;

class Order implements OrderInterface
{
    protected $cart     = null;
    protected $customer = null;
    protected $shipping = null;
    protected $payment  = null;

    protected $statusId = 1;
    protected $comment  = null;

    public function setCart(Cart $cart = null): OrderInterface
    {
        $this->cart = $cart;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCustomer(Customer $customer = null): OrderInterface
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setShipping(Shipping $shipping = null): OrderInterface
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    public function setPayment(Payment $payment = null): OrderInterface
    {
        $this->payment = $payment;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function setComment($comment = ''): OrderInterface
    {
        $this->comment = (string) $comment;

        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function toStore(): array
    {
        $currentLanguage = Shop::getCurrentLanguage();

        $cart     = $this->getCart();
        $customer = $this->getCustomer();
        $shipping = $this->getShipping();

        return [
            'order_status_id'  => $this->getStatusId(),
            'language_code'    => $currentLanguage->code,
            'currency_code'    => $cart->getCurrencyCode(),
            'price_type_id'    => $cart->getPriceTypeId(),

            'user_id'          => $customer->getId(),
            'first_name'       => $customer->getAttribute('first_name'),
            'last_name'        => $customer->getAttribute('last_name'),
            'email'            => $customer->getAttribute('email'),
            'phone'            => $customer->getAttribute('phone'),

            'shipping_type_id' => $shipping->getId(),
            'city'             => $shipping->getAttribute('city'),
            'street'           => $shipping->getAttribute('street'),
            'house_number'     => $shipping->getAttribute('house_number'),
            'apartment'        => $shipping->getAttribute('apartment'),
            'floor'            => $shipping->getAttribute('floor'),
            'entrance'         => $shipping->getAttribute('entrance'),
            'intercom'         => $shipping->getAttribute('intercom'),
            'post_code'        => $shipping->getAttribute('post_code'),

            'comment'          => $this->comment,
        ];
    }
}
