<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use Illuminate\Database\Eloquent\Collection;

interface PromoCode
{
    public function notExist(): bool;
    public function notActual(): bool;
    public function setModel($codeName = ''): void;
    public function validate(Cart $cart): PromoValidator;
    public function getConditions(): Collection;
}