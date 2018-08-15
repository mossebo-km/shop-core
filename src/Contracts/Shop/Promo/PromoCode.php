<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Promo\PromoValidator;

interface PromoCode
{
    public function notExist(): bool;
    public function notActual(): bool;
    public function setModel($codeName = ''): void;
    public function validate(Cart $cart): PromoValidator;
}