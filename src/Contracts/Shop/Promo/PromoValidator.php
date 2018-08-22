<?php

namespace MosseboShopCore\Contracts\Shop\Cart\Promo;

interface PromoValidator
{
    public function hasError(): bool;
    public function getErrorMessage(): ?string;
}