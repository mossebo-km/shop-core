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


    public function __construct($productId = null, $options = null, $quantity = 1)
    {
        if (is_null($options)) {
            $decoded = static::decodeKey($productId);

            $this->productId = $decoded['id'];
            $this->options = $decoded['options'];
        }
        else {
            $this->productId = $productId;
            $this->options = $options;
        }

        $this->setQuantity($quantity);
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
        $productData = $this->getProductData();

        if (is_null($productData)) {
            return false;
        }

        if ($this->options) {
            $allProductOptions = $productData->getOptions();

            foreach ($this->options as $optionId) {
                if (! in_array((int) $optionId, $allProductOptions)) {
                    return false;
                }
            }
        }

        return $productData->canBeShowed();
    }

    public function setPromoPrice()
    {
        $this->updatedAt = time();

        // TODO: Implement setPromoPrice() method.
    }

    protected static function makePrice($value, $currencyCode)
    {
        return Shop::make(PriceInterface::class, [
            'value' => $value,
            'currencyCode' => $currencyCode,
        ]);
    }

    protected function hasSale()
    {
        return Shop::sales()->hasActualSale('product', $this->getProductId());
    }

    public function setBasePriceTypeId($priceTypeId = null): CartProductInterface
    {
        $this->basePriceTypeId = $priceTypeId;

        return $this;
    }

    public function getBasePriceTypeId(): int
    {
        if (is_null($this->basePriceTypeId)) {
            $this->basePriceTypeId = Shop::getDefaultPriceTypeId();
        }

        return $this->basePriceTypeId;
    }

    public function setFinalPriceTypeId($priceTypeId = null): CartProductInterface
    {
        $this->finalPriceTypeId = $priceTypeId;

        return $this;
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

    public function setCurrencyCode($currencyCode = null): CartProductInterface
    {
        $this->currencyCode = $currencyCode;

        return $this;
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

    public function setAddedAtTimestamp($time = null): CartProductInterface
    {
        $this->addedAt = is_null($time) ? time() : $time;

        return $this;
    }

    public function getAddedAtTimestamp(): int
    {
        return $this->addedAt;
    }

    public function setUpdatedAtTimestamp($time = null): CartProductInterface
    {
        $this->updatedAt = is_null($time) ? time() : $time;

        return $this;
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

    public static function decodeKey($key): array
    {
        $keyArray = explode('-', $key);

        return [
            'id' => $keyArray[0],
            'options' => array_slice($keyArray, 1)
        ];
    }

    public function setProductData(CartProductDataInterface $data = null): CartProductInterface
    {
        $this->productData = $data;

        return $this;
    }

    public function getProductData(): ?CartProductDataInterface
    {
        if (is_null($this->productData)) {
            $this->productData = static::findProductData($this->getProductId(), $this->getOptions());
        }

        return $this->productData;
    }

    protected static function findProductData($id, $options = []): ?CartProductDataInterface
    {

    }

    public function getImage(): array
    {
        return $this->getProductData()->getImage();
    }

    public function getPrices(): array
    {
        return $this->getProductData()->getPrices();
    }

    public function getI18nTitles(): array
    {
        return $this->getProductData()->getI18nTitles();
    }

    public function getTitle($languageCode): ?string
    {
        $titles = $this->getI18nTitles();

        if ($titles && isset($titles[$languageCode])) {
            return $titles[$languageCode];
        }

        return null;
    }

    public function toStore($encodeParams = false)
    {
        $data = [
            'key'                 => $this->getKey(),
            'product_id'          => $this->getProductId(),
            'options'             => $this->getOptions(),
            'base_price_type_id'  => $this->getBasePriceTypeId(),
            'final_price_type_id' => $this->getFinalPriceTypeId(),
            'currency_code'       => $this->getCurrencyCode(),
            'quantity'            => $this->getQuantity(),
            'default_price'       => $this->getBasePrice()->getValue(),
            'final_price'         => $this->getFinalPrice()->getValue(),
            'created_at'          => $this->getAddedAtTimestamp(),
            'updated_at'          => $this->getUpdatedAtTimestamp(),

            'params'   => [
                'image'  => $this->getImage(),
                'prices' => $this->getPrices(),
                'titles' => $this->getI18nTitles(),
            ]
        ];

        if ($encodeParams) {
            $data['params'] = json_encode($data['params'], JSON_UNESCAPED_UNICODE);
        }

        return $data;
    }
}
