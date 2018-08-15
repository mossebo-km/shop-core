<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Models\Shop\Promo\PromoCode as PromoCodeModel;

interface PromoCode
{
    public function notExist(): bool;
    public function notActual(): bool;

    protected function getModel($codeName = ''): PromoCodeModel;

    public function canBeApplyedByCart(Cart $cart): PromoValidator;
}