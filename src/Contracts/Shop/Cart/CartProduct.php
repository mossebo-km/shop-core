<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Price;

interface CartProduct
{
    public function isExist(): bool;
    public function getResource();
    public function setPromoPrice();
    public function setKey($key);
    public function getKey(): string;
    public function getQuantity(): int;
    public function getBasePrice($typeId, $currencyCode): ?Price;
    public function getFinalPrice($typeId, $currencyCode): ?Price;
    public function getAddedAtTimestamp(): ?int;
    public function getUpdatedAtTimestamp(): ?int;

    public function add($num): int;
    public function remove($num): int;
    public function setQuantity($num): int;

    public function toStore();

    public static function makeKey();
    public static function decodeKey(): array;

    public static function makeByKey($productKey, $quantity = 1): CartProduct;
}