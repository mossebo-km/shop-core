<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Models\User;

interface Cart
{
    public function hasUser(): bool;
    public function getUser(): User;
    public function getProducts(): Collection;
    public function getCurrencyCode(): string;
    public function getAmount(): integer;
    public function getProductsQuantity(): integer;
    public function setAmountDiscount($amount, $currencyCode, $percent = 0, $isSummable = false): void;
    public function setPercentDiscount($percent, $isSummable = false): void;
    public function getBestDiscount();
}