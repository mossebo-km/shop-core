<?php

namespace MosseboShopCore\Shop\Order\Builders;

use Shop;
use MosseboShopCore\Shop\Cart\Builders\ModelCartLoader;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;
use MosseboShopCore\Contracts\Shop\Payment\Payment as PaymentInterface;
use MosseboShopCore\Contracts\Shop\Shipping\Shipping as ShippingInterface;

class ModelOrderBuilder extends AbstractOrderBuilder
{
    protected $orderData = null;

    public function __construct($data)
    {
        $this->orderData = $data;
    }

    protected function getId(): ?int
    {
        return $this->orderData->id;
    }

    protected function getCart(): ?CartInterface
    {
        return Shop::makeCart(ModelCartLoader::class, $this->orderData);
    }

    protected function getCustomer(): ?CustomerInterface
    {
        return $this->orderData->user;
    }

    protected function getShipping(): ?ShippingInterface
    {
        $shipping = Shop::make(ShippingInterface::class);

        $shipping->fill($this->orderData->toArray());

        return $shipping;
    }

    protected function getPayment(): ?PaymentInterface
    {
        return Shop::make(PaymentInterface::class);
    }

    protected function getComment(): ?string
    {
        return $this->orderData->comment;
    }
}
