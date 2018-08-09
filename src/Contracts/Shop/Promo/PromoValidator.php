<?php

namespace MosseboShopCore\Contracts\Shop\Promo;

interface PromoValidator
{
    public function hasError(): bool;
    public function getMessage(): string;
}