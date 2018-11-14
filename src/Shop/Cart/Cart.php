<?php

namespace MosseboShopCore\Shop\Cart;

use Auth;
use Shop;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Customer;
use MosseboShopCore\Shop\Price;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Price as PriceInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;

class Cart implements CartInterface
{
    protected $customer          = null;
    protected $products          = null;
    protected $currencyCode      = null;
    protected $promoCode         = null;
    protected $lastPromoCodeInfo = null;
    protected $priceTypeId       = null;
    protected $createdAt         = null;
    protected $updatedAt         = null;

    protected $amount            = null;
    protected $total             = null;

    public function hasCustomer(): bool
    {
        return ! is_null($this->customer);
    }

    public function setCustomer(Customer $customer = null): CartInterface
    {
        $this->customer = $customer;

        $this->hasChanged();

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setProducts(Collection $products = null): CartInterface
    {
        $this->products = $products;

        $this->hasChanged();

        return $this;
    }

    /**
     * Коллекция товаров, находящихся в корзине
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getProducts(): Collection
    {
        return clone $this->products;
    }

    /**
     * Возвращает количество товаров в корзине
     *
     * @return int
     */
    public function getProductsQuantity(): int
    {
        $quantity = 0;

        foreach ($this->getProducts() as $product) {
            $quantity += $product->getQuantity();
        }

        return $quantity;
    }

    /**
     * Возвращает количество наименований товаров в корзине
     *
     * @return int
     */
    public function getProductItemsQuantity(): int
    {
        return $this->getProducts()->count();
    }


    /**
     * Возвращает текущую суммарную цену товаров в корзине
     *
     * @return PriceInterface
     * @throws \Exception
     */
    public function getAmount(): PriceInterface
    {
        if (! is_null($this->amount)) {
            return $this->amount;
        }

        $products = $this->getProducts();

        $this->amount = Shop::make(Price::class, [
            'value' => 0,
            'currencyCode' => $this->getCurrencyCode(),
        ]);

        foreach ($products as $product) {
            $price = $product->getTotalFinalPrice();

            $this->amount->plus($price);
        }

        $this->amount->setValue(
            ceil($this->amount->getValue())
        );

        return $this->amount;
    }

    public function getProductsTotal(): PriceInterface
    {
        if (! is_null($this->total)) {
            return $this->total;
        }

        $this->total = clone $this->getAmount();

        if (! is_null($this->promoCode)) {
            $this->total = $this->promoCode->apply($this->total);
        }

        return $this->total;
    }

    public function getTotal(): PriceInterface
    {
        return $this->getProductsTotal();
    }


    /**
     * Устанавливает код валюты.
     *
     * @param $currencyCode
     */
    public function setCurrencyCode($currencyCode = null): CartInterface
    {
        $this->currencyCode = $currencyCode;

        if (! is_null($this->products)) {
            $this->products->each(function (CartProduct $product) use($currencyCode) {
                $product->setCurrencyCode($currencyCode);
            });
        }

        $this->hasChanged();

        return $this;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function setPriceTypeId($priceTypeId = null): CartInterface
    {
        $this->priceTypeId = $priceTypeId;

        if (! is_null($this->products)) {
            $this->products->each(function (CartProduct $product) use($priceTypeId) {
                $product->setBasePriceTypeId($priceTypeId);
                $product->setFinalPriceTypeId(null);
            });
        }

        $this->hasChanged();

        return $this;
    }

    public function getPriceTypeId(): int
    {
        return $this->priceTypeId;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * Устанавливает промокод.
     *
     * @param $currencyCode
     */
    public function setPromoCode(PromoCode $code)
    {
        $this->promoCode = $code;

        $this->hasChanged();

        return $this;
    }

    /**
     * Сбрасывает промокод.
     */
    public function clearPromoCode()
    {
        $this->promoCode = null;

        $this->hasChanged();

        return $this;
    }

    public function getPromoCode(): ?PromoCode
    {
        return $this->promoCode;
    }

    public function getLastPromoCodeInfo(): ?array
    {
        return $this->lastPromoCodeInfo;
    }

    /**
     * Сбрасываем промокод, если он перестал подходить.
     */
    protected function checkPromo()
    {
        if (is_null($this->promoCode)) return;

        $validator = $this->promoCode->validate($this);

        if ($validator->hasError()) {
            $this->lastPromoCodeInfo = [
                'error' => $validator->getErrorMessage(),
                'code' => $this->promoCode
            ];

            $this->promoCode = null;
        }
    }


    /**
     * Работа с товарами
     *
     * @param $productKey
     * @return null
     */

    protected function findProductByKey($productKey)
    {
        foreach ($this->products as $product) {
            if ($product->getKey() === $productKey) {
                return $product;
            }
        }

        return null;
    }

    /**
     * Добавление товара по ключу
     *
     * @param $productKey
     * @param int $quantity
     */
    public function addProductByKey($productKey, $quantity = 1)
    {
        $this->handleProductOperation('add', $productKey, $quantity);

        return $this;
    }

    public function setProductByKey($productKey, $quantity)
    {
        $this->handleProductOperation('setQuantity', $productKey, $quantity);

        return $this;
    }

    protected function handleProductOperation($method, $productKey, $quantity)
    {
        $product = $this->findProductByKey($productKey);

        if (is_null($product)) {
            $product = Shop::make(CartProductInterface::class, [
                'productId' => $productKey,
                'quantity' => $quantity
            ]);

            $product->setPriceTypeId($this->getPriceTypeId());
            $product->setCurrencyCode($this->getCurrencyCode());

            $this->products->prepend($product);
        }
        else {
            $product->$method($quantity);
        }

        $this->hasChanged();
    }

    public function removeProductByKey($productKey)
    {
        $this->products = $this->products->reject(function ($product) use($productKey) {
            return $product->getKey() === $productKey;
        });

        $this->hasChanged();

        return $this;
    }

    /**
     * Отчистка корзины
     */
    public function clear()
    {
        $this->clearProducts();
        $this->promoCode = null;

        $this->hasChanged();

        return $this;
    }

    public function clearProducts()
    {
        $this->products = new Collection;

        return $this;
    }

    /**
     * Очищает вычисляемые данные
     */
    protected function hasChanged()
    {
        $this->amount = null;
        $this->total = null;
        $this->setUpdatedAt(time());

        $this->checkPromo();
    }

    public function setCreatedAt($createdAt = null): CartInterface
    {
        $this->createdAt = is_null($createdAt) ? time() : $createdAt;

        return $this;
    }

    public function setUpdatedAt($updatedAt = null): CartInterface
    {
        $this->updatedAt = is_null($updatedAt) ? time() : $updatedAt;

        return $this;
    }

    /**
     * Декодируют ключ предмета из корзины. Возвращает массив из id и параметров товара.
     *
     * @param String $key
     * @return array
     */
    public static function decodeKey(string $key): array
    {
        return CartProduct::decodeKey($key);
    }
}
