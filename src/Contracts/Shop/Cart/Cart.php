<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Shop\User;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;
use MosseboShopCore\Contracts\Shop\Price;


interface Cart
{
    public function hasUser(): bool;
    public function getUser(): ?User;

    public function getProducts(): Collection;

    public function getCurrencyCode(): string;
    public function getPriceTypeId(): int;

    public function getAmount(): Price;

    public function getProductsQuantity(): int;
    public function getProductNamesQuantity(): int;

//    public function setAmountDiscount($amount, $currencyCode, $percent = 0, $isSummable = false): void;
//    public function setPercentDiscount($percent, $isSummable = false): void;
//    public function getBestDiscount();

    public function setPromoCode(PromoCode $code);
    public function getPromoCode(): ?PromoCode;

    public function getCreatedAt(): int;
    public function getUpdatedAt(): int;

    public function addProductByKey($productKey, $quantity = 1);
    public function setProductByKey($productKey, $quantity);
    public function removeProductByKey($productKey);
}