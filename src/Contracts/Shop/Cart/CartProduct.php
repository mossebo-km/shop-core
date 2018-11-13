<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Price;
use MosseboShopCore\Contracts\Shop\Product\Product;

interface CartProduct extends Product
{
    public function isExist(): bool;

    public function getKey(): string;
    public function getProductId();
    public function getOptions(): array;

    public function getQuantity(): int;
    public function getBasePriceTypeId(): int;
    public function getFinalPriceTypeId(): int;
    public function getPrice($typeId, $currencyCode): ?Price;
    public function getBasePrice($typeId = null, $currencyCode = null): ?Price;
    public function getFinalPrice($typeId = null, $currencyCode = null): ?Price;
    public function getTotalFinalPrice($typeId = null, $currencyCode = null): ?Price;
    public function getAddedAtTimestamp(): ?int;
    public function getUpdatedAtTimestamp(): ?int;
    public function getCurrencyCode();

    public function add($num): int;
    public function remove($num): int;
    public function setQuantity($num): int;

    public function toStore($encodeParams = false);

    public static function makeKey($id, $options = []);
    public static function decodeKey(string $key): array;

    public function initByKey($productKey, $quantity = 1, $basePriceTypeId = null, $finalPriceTypeId = null, $currencyCode = null);
}