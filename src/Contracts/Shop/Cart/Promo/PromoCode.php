<?php

namespace MosseboShopCore\Contracts\Shop\Cart\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Price;
use Illuminate\Database\Eloquent\Collection;

interface PromoCode
{
    public function notExist(): bool;
    public function notActual(): bool;
    public function setResource($codeIdOrName = ''): void;
    public function validate(Cart $cart): PromoValidator;
    public function getConditions(): Collection;
    public function getName(): string;
    public function apply(Price $price): Price;
    public function getDiscountPrice(Price $price): Price;
}