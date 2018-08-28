<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartProductData
{
    public function getImage();
    public function getI18nTitles();
    public function getTitle($languageCode);
    public function getPrices();
    public function getOptions(): array;
    public function canBeShowed(): bool;
}