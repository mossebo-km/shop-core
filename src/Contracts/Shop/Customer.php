<?php

namespace MosseboShopCore\Contracts\Shop;

interface Customer
{
    public function getPriceTypeId(): ?int;
    public function ordersCount(): int;
    public function getPromoCodeUsesNum($promoCodeId): int;
}