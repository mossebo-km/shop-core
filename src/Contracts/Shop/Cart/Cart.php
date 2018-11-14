<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;
use MosseboShopCore\Contracts\Shop\Price;


interface Cart
{
    public function hasCustomer(): bool;
    public function setCustomer(Customer $customer = null): Cart;
    public function getCustomer(): ?Customer;

    public function setProducts(Collection $products = null): Cart;
    public function getProducts(): Collection;

    public function setCurrencyCode($currencyCode = null): Cart;
    public function getCurrencyCode(): string;

    public function setPriceTypeId($priceTypeId = null): Cart;
    public function getPriceTypeId(): int;

    public function getAmount(): Price;
    public function getProductsTotal(): Price;
    public function getTotal(): Price;

    public function getProductsQuantity(): int;
    public function getProductItemsQuantity(): int;

    public function setPromoCode(PromoCode $code);
    public function clearPromoCode();
    public function getPromoCode(): ?PromoCode;
    public function getLastPromoCodeInfo(): ?array;

    public function setCreatedAt($createdAt = null): Cart;
    public function getCreatedAt(): int;

    public function setUpdatedAt($updatedAt = null): Cart;
    public function getUpdatedAt(): int;

    public function addProductByKey($productKey, $quantity = 1);
    public function setProductByKey($productKey, $quantity);
    public function removeProductByKey($productKey);
}