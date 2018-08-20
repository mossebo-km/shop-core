<?php

namespace MosseboShopCore\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;

class CartProductData implements CartProductDataInterface
{
    protected $data = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    protected function get($key): ?array
    {
        if (isset($this->data[$key]) && is_array($this->data[$key])) {
            return $this->data[$key];
        }

        return null;
    }

    public function getImage(): ?array
    {
        return $this->get('image');
    }

    public function getI18nTitles(): ?array
    {
        return $this->get('titles');
    }

    public function getPrices(): ?array
    {
        return $this->get('prices');
    }

    public function getOptions(): array
    {
        $options = $this->get('options');

        return is_null($options) ? [] : $options;
    }

    public function canBeShowed(): bool
    {
        // TODO: Implement canBeShow() method.
//        ????
    }
}
