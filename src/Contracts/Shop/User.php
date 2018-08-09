<?php

namespace MosseboShopCore\Contracts\Shop;

interface User
{
    public function ordersCount(): integer;
    public function getPromoCodeUsesNum(integer $promoCodeId): integer;
}