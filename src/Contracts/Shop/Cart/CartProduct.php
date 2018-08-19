<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Price;
use MosseboShopCore\Models\Shop\Product;

interface CartProduct
{
    public function isExist(): bool;
    public function getResource();
    public function setPromoPrice();
    public function setKey($key);
    public function getKey(): string;
    public function getQuantity(): integer;
    public function getBasePrice($typeId, $currencyCode): ?Price;
    public function getFinalPrice($typeId, $currencyCode): ?Price;
    public function getAddedAtTimestamp(): ?integer;
    public function getUpdatedAtTimestamp(): ?integer;

    public function add($num): integer;
    public function remove($num): integer;
    public function setQuantity($num): integer;

    public function toStore();

    public static function makeKey();
    public static function decodeKey(): array;

    public static function makeByKey($productKey, $quantity = 1): CartProduct;
}