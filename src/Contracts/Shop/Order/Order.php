<?php

namespace MosseboShopCore\Contracts\Shop\Order;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Delivery\Delivery;
use MosseboShopCore\Contracts\Shop\Payment\Payment;

interface Order
{
//    public function getOrder(): Order;

    public function setCart(Cart $cart = null);
    public function setCustomer(Customer $customer = null);
    public function setDelivery(Delivery $delivery = null);
    public function setPayment(Payment $payment = null);
}