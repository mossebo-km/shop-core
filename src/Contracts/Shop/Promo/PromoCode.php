<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;

interface PromoCode
{
    public function notExist(): bool;
    public function notActual(): bool;

    public function canBeApplyedByCart(Cart $cart): PromoValidator;
}