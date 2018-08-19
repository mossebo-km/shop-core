<?php

namespace MosseboShopCore\Contracts\Shop\Cart;

interface CartProductData
{
    public function getImage();
    public function getI18nTitles();
    public function getPrices();
}