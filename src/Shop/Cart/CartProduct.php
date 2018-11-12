<?php

namespace MosseboShopCore\Shop\Cart;

use Shop;
use Event;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;
use MosseboShopCore\Contracts\Shop\Price as PriceInterface;

abstract class CartProduct implements CartProductInterface
{
    protected $key              = null;
    protected $productId        = null;
    protected $options          = [];
    protected $quantity         = null;
    protected $productData      = null;
    protected $basePriceTypeId  = null;
    protected $finalPriceTypeId = null;
    protected $currencyCode     = null;

    protected $addedAt          = null;
    protected $updatedAt        = null;

    protected $basePrice        = null;
    protected $finalPrice       = null;

    public function __construct($productId = null, $options = [], $quantity = 1, $basePriceTypeId = null, $finalPriceTypeId = null, $currencyCode = null, $addedAt = null, $updatedAt = null, CartProductDataInterface $productData = null)
    {
        if (! is_null($productId)) {
            $this->init($productId, $options, $quantity, $basePriceTypeId, $finalPriceTypeId, $currencyCode, $addedAt, $updatedAt, $productData);
        }
    }

    public function init($productId, $options = [], $quantity = 1, $basePriceTypeId = null, $finalPriceTypeId = null, $currencyCode = null, $addedAt = null, $updatedAt = null, CartProductDataInterface $productData = null)
    {
        $this->productId        = $productId;
        $this->options          = $options;
        $this->quantity         = $quantity;
        $this->basePriceTypeId  = $basePriceTypeId;
        $this->finalPriceTypeId = $finalPriceTypeId;
        $this->currencyCode     = $currencyCode;
        $this->addedAt          = is_null($addedAt) ? time() : $addedAt;
        $this->updatedAt        = is_null($updatedAt) ? time() : $updatedAt;
        $this->productData      = $productData;
    }

    public function initByKey($productKey, $quantity = 1, $basePriceTypeId = null, $finalPriceTypeId = null, $currencyCode = null)
    {
        $decoded = static::decodeKey($productKey);

        $this->init(
            $decoded['id'],
            $decoded['options'],
            $quantity,
            $basePriceTypeId,
            $finalPriceTypeId,
            $currencyCode,
            time(),
            time(),
            static::findCartProductData($decoded['id'], $decoded['options'])
        );
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getProductId()
    {
        // TODO: Implement getProductId() method.

        return $this->productId;
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

        return $this->quantity = max(1, $quantity);
    }

    public function getQuantity(): int
    {
        $this->updatedAt = time();

        return $this->quantity;
    }

    public function isExist(): bool
    {
        if (is_null($this->productData)) {
            return false;
        }

        if ($this->options) {
            $allProductOptions = $this->productData->getOptions();

            foreach ($this->options as $optionId) {
                if (! in_array((int) $optionId, $allProductOptions)) {
                    return false;
                }
            }
        }

        return $this->productData->canBeShowed();
    }

    public function setPromoPrice()
    {
        $this->updatedAt = time();

        // TODO: Implement setPromoPrice() method.
    }

    protected static function makePrice($value, $currencyCode)
    {
        return app()->makeWith(PriceInterface::class, [
            'value' => $value,
            'currencyCode' => $currencyCode,
        ]);
    }

    protected function hasSale()
    {
        return Shop::sales()->hasActualSale('product', $this->getProductId());
    }

    public function getBasePriceTypeId(): int
    {
        if (is_null($this->basePriceTypeId)) {
            $this->basePriceTypeId = Shop::getDefaultPriceTypeId();
        }

        return $this->basePriceTypeId;
    }

    public function getFinalPriceTypeId(): int
    {
        if (is_null($this->finalPriceTypeId)) {
            if ($this->hasSale()) {
                $this->finalPriceTypeId = Shop::getPriceTypeId('sale');
            }
            else {
                $this->finalPriceTypeId = $this->getBasePriceTypeId();
            }
        }

        return $this->finalPriceTypeId;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getPrice($typeId, $currencyCode): ?PriceInterface
    {
        foreach ($this->getPrices() as $price) {
            if ($price['price_type_id'] === $typeId && $price['currency_code'] === $currencyCode) {
                return static::makePrice($price['value'], $currencyCode);
            }
        }

        return null;
    }

    public function getBasePrice($typeId = null, $currencyCode = null): ?PriceInterface
    {
        return $this->getPrice(
            is_null($typeId) ? $this->getBasePriceTypeId() : $typeId,
            is_null($currencyCode) ? $this->getCurrencyCode() : $currencyCode
        );
    }

    public function getFinalPrice($typeId = null, $currencyCode = null): ?PriceInterface
    {
        $finalPrice = $this->getPrice(
            is_null($typeId) ? $this->getFinalPriceTypeId() : $typeId,
            is_null($currencyCode) ? $this->getCurrencyCode() : $currencyCode
        );

        // TODO: Если потребуется доделать цену с учетом промокода или других модификаторов цены.
        return $finalPrice ? $finalPrice : $this->getBasePrice($typeId, $currencyCode);
    }

    public function getTotalFinalPrice($typeId = null, $currencyCode = null): ?PriceInterface
    {
        $price = clone $this->getFinalPrice($typeId, $currencyCode);
        $price->setValue($price->getValue() * $this->getQuantity());

        return $price;
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

    protected static function findCartProductData($id, $options = []): ?CartProductDataInterface
    {

    }

    public function getImage()
    {
        return $this->productData->getImage();
    }

    public function getPrices()
    {
        return $this->productData->getPrices();
    }

    public function getI18nTitles()
    {
        return $this->productData->getI18nTitles();
    }

    public function getTitle($languageCode)
    {
        $titles = $this->getI18nTitles();

        if (isset($titles[$languageCode])) {
            return $titles[$languageCode];
        }

        return null;
    }

    public function toStore()
    {
        return [
            'key'                 => $this->getKey(),
            'product_id'          => $this->getProductId(),
            'options'             => $this->getOptions(),
            'quantity'            => $this->getQuantity(),
            'base_price_type_id'  => $this->getBasePriceTypeId(),
            'final_price_type_id' => $this->getFinalPriceTypeId(),
            'currency_code'       => $this->getCurrencyCode(),
            'created_at'          => $this->getAddedAtTimestamp(),
            'updated_at'          => $this->getUpdatedAtTimestamp(),

            'params'   => [
                'image'  => $this->getImage(),
                'prices' => $this->getPrices(),
                'titles' => $this->getI18nTitles(),
            ]
        ];
    }
}
