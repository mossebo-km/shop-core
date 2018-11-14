<?php

namespace MosseboShopCore\Contracts\Shop\Order;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Shipping\Shipping;
use MosseboShopCore\Contracts\Shop\Payment\Payment;

interface Order
{
//    public function getOrder(): Order;

    public function setId($id): Order;
    public function getId(): ?int;

    public function setCart(Cart $cart = null): Order;
    public function getCart(): ?Cart;
    public function setCustomer(Customer $customer = null): Order;
    public function getCustomer(): ?Customer;
    public function setShipping(Shipping $shipping = null): Order;
    public function getShipping(): ?Shipping;
    public function setPayment(Payment $payment = null): Order;
    public function getPayment(): ?Payment;
    public function setComment($comment = ''): Order;
    public function getComment(): string;
    public function getStatusId();

    public function toStore(): array;
}