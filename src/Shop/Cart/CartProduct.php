<?php

namespace MosseboShopCore\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;
use MosseboShopCore\Contracts\Shop\Price as PriceInterface;
use MosseboShopCore\Shop\Price;

abstract class CartProduct implements CartProductInterface
{
    protected $key         = null;
    protected $productId   = null;
    protected $options     = null;
    protected $quantity    = null;
    protected $productData = null;
    protected $addedAt     = null;
    protected $updatedAt   = null;

    protected $basePrice   = null;
    protected $finalPrice  = null;

    public function __construct($productId, $options = [], $quantity = 1, $addedAt = null, $updatedAt = null, CartProductDataInterface $productData = null)
    {
        $this->productId   = $productId;
        $this->options     = $options;
        $this->quantity    = $quantity;
        $this->addedAt     = is_null($addedAt) ? time() : $addedAt;
        $this->updatedAt   = is_null($updatedAt) ? time() : $updatedAt;
        $this->productData = $productData;
    }

    public function getKey(): string
    {
        if (is_null($this->key)) {
            $this->key = static::makeKey($this->productId, $this->options);
        }

        return $this->key;
    }

    public function add($num): int
    {
        // todo: Остатки
        return $this->setQuantity($this->quantity + $num);
    }

    public function remove($num): int
    {
        return $this->setQuantity($this->quantity - $num);
    }

    public function setQuantity($quantity): int
    {
        // todo: Остатки

        $this->updatedAt = time();

        return $this->quantity = min(1, $quantity);
    }


    public function getQuantity(): int
    {
        $this->updatedAt = time();

        return $this->quantity;
    }

    public function isExist(): bool
    {
        if (is_null($this->resource)) {
            return false;
        }

        if ($this->options) {
            $optionsDiff = array_diff($this->options, array_column($this->resource->options->toArray(), 'id'));

            if (! empty($optionsDiff)) {
                // todo:: можно помечать товар как недоступный, а не просто убирать его из корзины.
                return false;
            }
        }

        return $this->resource->canBeShowed();
    }

    public function setPromoPrice()
    {
        $this->updatedAt = time();

        // TODO: Implement setPromoPrice() method.
    }

    public function setBasePrice($value, $currencyCode)
    {
        $this->basePrice = app()->makeWith(Price::class, [
            'value' => $value,
            'currencyCode' => $currencyCode,
        ]);
    }

    public function getBasePrice($typeId, $currencyCode): ?PriceInterface
    {
        if (! is_null($this->basePrice)) {
            return $this->basePrice;
        }

        foreach ($this->resource->prices as $price) {
            if ($price->price_type_id === $typeId && $price->currency_code === $currencyCode) {
                return app()->makeWith(Price::class, [
                    'value' => $price->value,
                    'currencyCode' => $currencyCode,
                ]);
            }
        }

        return null;
    }

    public function setFinalPrice($value, $currencyCode)
    {
        $this->finalPrice = app()->makeWith(Price::class, [
            'value' => $value,
            'currencyCode' => $currencyCode,
        ]);
    }

    public function getFinalPrice($typeId, $currencyCode): ?PriceInterface
    {
        if (! is_null($this->finalPrice)) {
            return $this->finalPrice;
        }
        // TODO: Implement getPrice() method.

        return $this->getBasePrice($typeId, $currencyCode);
    }


    public function getAddedAtTimestamp(): int
    {
        return $this->addedAt;
    }

    public function getUpdatedAtTimestamp(): int
    {
        return $this->updatedAt;
    }


    public static function makeKey($id, $options = [])
    {
        $key = array_merge([$id], $options);

        return implode('-', $key);
    }

    public static function decodeKey(string $key): array
    {
        $keyArray = explode('-', $key);

        return [
            'id' => $keyArray[0],
            'options' => array_slice($keyArray, 1)
        ];
    }

    public static function makeByKey($productKey, $quantity = 1): CartProduct
    {
        $decoded = static::decodeKey($productKey);

        return new static(
            $decoded['id'],
            $decoded['options'],
            $quantity,
            time(),
            time(),
            static::findCartProductData($decoded['id'], $decoded['options'])
        );
    }

    protected static function findCartProductData($id, $options = []): ?Product
    {

    }

    public function toStore()
    {
        return [
            'key'       => $this->key,
            'productId' => $this->productId,
            'options'   => $this->options,
            'addedAt'   => $this->addedAt,
            'updatedAt' => $this->updatedAt,

            'product'   => [
                'image'  => $this->productData->getImage(),
                'prices' => $this->productData->getPrices(),
                'titles' => $this->productData->getI18nTitles(),
            ]
        ];
    }
}