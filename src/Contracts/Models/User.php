<?php

namespace MosseboShopCore\Contracts\Models;

interface User
{
    public function ordersCount(): integer;
    public function getPromoCodeUsesNum($promoCodeId): integer;
}