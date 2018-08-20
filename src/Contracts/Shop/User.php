<?php

namespace MosseboShopCore\Contracts\Shop;

interface User
{
    public function getPriceTypeId(): ?int;
    public function ordersCount(): int;
    public function getPromoCodeUsesNum($promoCodeId): int;
}