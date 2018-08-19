<?php

namespace MosseboShopCore\Shop\Cart\Storage\Session;

use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode;
use MosseboShopCore\Contracts\Shop\User;

class CartSessionLoader extends CartSessionConnector
{
    protected $cartData = null;

    protected function getCartData($key = null)
    {
        if (is_null($this->cartData)) {
            $this->cartData = $this->get('cart', false);
        }

        if (! $this->cartData) {
            $this->cartData = $this->makeEmptyCartData();
        }

        if (is_null($key)) {
            return $this->cartData;
        }

        if (isset($this->cartData[$key])) {
            return $this->cartData[$key];
        }

        return null;
    }

    protected function makeEmptyCartData()
    {
        return [
            'products'     => [],
            'currencyCode' => Shop::getCurrentCurrencyCode(),
            'promoCode'    => null,
            'discounts'    => [],
            'createdAt'    => time(),
            'updatedAt'    => time(),
        ];
    }

    public function __call($methodName)
    {
        return $this->getCartData(
            str_replace('get', '', $methodName)
        );
    }

    public function getUser(): ?User
    {
        return Auth::user();
    }

    public function getProducts(): Collection
    {
        return Cache::remember(static::makeStorageKey('products'), 5, function () {
            return $this->buildCartProducts();
        });
    }

    public function find($cartProducts)
    {

    }

    protected function buildCartProducts()
    {
        $storedProducts = $this->getCartData('products');

        $productsDataFinder = new ProductsDataFinder();

        $products = $productsDataFinder->find(
            $this->getCartData('products')
        );


        $ids = array_unique(array_column($storedProducts, 'id'));


        // todo: товары то без связей
        $products = Product::enabled()
            ->whereIn('id', $ids)
            ->with(['image', 'prices', 'currentI18n', 'options'])
            ->get();

        $result = new Collection;

        foreach ($storedProducts as $storedProduct) {
            $product = $products->where('id', $storedProduct['id'])->first();

            if (is_null($product)) {
                continue;
            }

            $cartProduct = app()->makeWith(CartProduct::class, [
                'id'       => $storedProduct['id'],
                'options'  => $storedProduct['options'],
                'quantity' => $storedProduct['quantity'],
                'product'  => $product
            ]);

            if ($cartProduct->isExist()) {
                $result->push($cartProduct);
            }
        }

        return $result;
    }

    protected function getPromoCode()
    {
        $promoCodeName = $this->getCartData('promoCode');

        if (is_null($promoCodeName)) {
            return null;
        }

        return app()->makeWith(PromoCode::class, [
            'name' => $promoCodeName
        ]);
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

