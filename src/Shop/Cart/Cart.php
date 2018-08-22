<?php

namespace MosseboShopCore\Shop\Cart;

use Auth;
use Shop;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\User;
use MosseboShopCore\Shop\Price;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Price as PriceInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;
use MosseboShopCore\Shop\Cart\Traits\HasDiscount;

class Cart implements CartInterface
{
    use HasDiscount;

    protected $products     = null;
    protected $currencyCode = null;
    protected $promoCode    = null;
    protected $discounts    = [];
    protected $createdAt    = null;
    protected $updatedAt    = null;

    protected $amount       = null;
    protected $total        = null;

    public function __construct(Collection $products, $currencyCode, $promoCode = null, $discounts = [], $createdAt = null, $updatedAt = null)
    {
        $this->products     = $products;
        $this->currencyCode = $currencyCode;
        $this->promoCode    = $promoCode;
        $this->discounts    = $discounts;
        $this->createdAt    = is_null($createdAt) ? time() : $createdAt;
        $this->updatedAt    = is_null($updatedAt) ? time() : $updatedAt;
    }

    public function hasUser(): bool
    {
        return ! is_null(Auth::user());
    }

    public function getUser(): User
    {
        return Auth::user();
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
    public function getProductNamesQuantity(): int
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

        $priceTypeId = $this->getPriceTypeId();
        $currencyCode = $this->getCurrencyCode();

        $this->amount = app()->makeWith(Price::class, [
            'value' => 0,
            'currencyCode' => $currencyCode,
        ]);

        foreach ($products as $product) {
            $this->amount->plus($product->getBasePrice(
                $priceTypeId,
                $currencyCode
            ));
        }

        return $this->amount;
    }

    public function getTotal()
    {
        if (is_null($this->promoCode)) {
            $this->total = $this->amount;
        }
        else {
            $this->total = $this->promoCode->apply($this->amount);
        }
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getPriceTypeId(): int
    {
        if ($this->hasUser()) {
            return $this->getUser()->getPriceTypeId();
        }
        else {
            return Shop::getDefaultPriceTypeId();
        }
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
     * Устанавливает код валюты.
     *
     * @param $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        $this->hasChanged();
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
    }

    public function getPromoCode(): ?PromoCode
    {
        return $this->promoCode;
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
    }

    public function setProductByKey($productKey, $quantity)
    {
        $this->handleProductOperation('setQuantity', $productKey, $quantity);
    }

    protected function handleProductOperation($method, $productKey, $quantity)
    {
        $product = $this->findProductByKey($productKey);

        if (is_null($product)) {
            $product = app()->make(CartProductInterface::class);

            $product->initByKey($productKey, $quantity);

            $this->products->push($product);
        }
        else {
            $product->$method($quantity);
        }

        $this->hasChanged();
    }

    public function removeProductByKey($productKey)
    {
        $this->products->reject(function ($product) use($productKey) {
            return $product->getKey() === $productKey;
        });

        $this->hasChanged();
    }

    /**
     * Отчистка корзины
     */
    public function clear()
    {
        $this->products = new Collection;
        $this->promoCode = null;
        $this->discounts = [];

        $this->hasChanged();
    }

    /**
     * Удаляет вычисляемые данные
     */
    protected function hasChanged()
    {
        $this->amount = null;
        $this->updatedAt = time();

        $this->checkPromo();
    }

    /**
     * Сбрасываем промокод, если он перестал подходить.
     */
    protected function checkPromo()
    {
        if (is_null($this->promoCode)) return;

        $validator = $this->promoCode->validate($this);

        if ($validator->hasError()) {
            $this->promoCode = null;
        }
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
