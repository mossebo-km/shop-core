<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Price;

interface CartProduct
{
    public function isExist(): bool;

    public function getKey(): string;
    public function getProductId();
    public function getOptions(): array;

    public function getQuantity(): int;
    public function getBasePrice($typeId, $currencyCode): ?Price;
    public function getFinalPrice($typeId, $currencyCode): ?Price;
    public function getAddedAtTimestamp(): ?int;
    public function getUpdatedAtTimestamp(): ?int;

//    public function setPromoPrice();

    public function add($num): int;
    public function remove($num): int;
    public function setQuantity($num): int;

    public function toStore();

    public static function makeKey($id, $options = []): CartProductInterface;
    public static function decodeKey(): array;

    public static function makeByKey($productKey, $quantity = 1): CartProduct;
}