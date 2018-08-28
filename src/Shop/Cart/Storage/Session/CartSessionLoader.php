<?php

namespace MosseboShopCore\Shop\Cart\Storage\Session;

use Illuminate\Session\SessionManager;
use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use MosseboShopCore\Contracts\Shop\Cart\CartLoader;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;
use MosseboShopCore\Contracts\Shop\User;
use MosseboShopCore\Shop\Cart\CartProductData;

class CartSessionLoader extends CartSessionConnector implements CartLoader
{
    protected $cartData = null;

    public function getCart(): CartInterface
    {
        return app()->makeWith(CartInterface::class, $this->getCartContent());
    }

    public function getCartContent()
    {
        return [
            'user'         => $this->getUser(),
            'products'     => $this->getProducts(),
            'currencyCode' => $this->getCurrencyCode(),
            'promoCode'    => $this->getPromoCode(),
            'createdAt'    => $this->getCreatedAt(),
            'updatedAt'    => $this->getUpdatedAt(),
        ];
    }

    protected function getCartData($key = null)
    {
        if (is_null($this->cartData)) {
            $this->cartData = $this->get('cart');
        }

        if (is_null($this->cartData)) {
            $this->cartData = $this->makeEmptyCartData();
        }

        if (is_null($key)) {
            return $this->cartData;
        }

        if (array_has($this->cartData, $key)) {
            return array_get($this->cartData, $key);
        }

        return null;
    }

    protected function makeEmptyCartData()
    {
        $defaultPromo = Shop::getDefaultPromoCode();

        return [
            'products'     => [],
            'currencyCode' => Shop::getCurrentCurrencyCode(),
            'promoCode'    => $defaultPromo ? $defaultPromo : null,
            'createdAt'    => time(),
            'updatedAt'    => time(),
        ];
    }

    public function __call($methodName, $arguments = null)
    {
        $key = str_replace('get', '', $methodName);
        $key = lcfirst($key);

        return $this->getCartData($key);
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

    protected function buildCartProducts()
    {
        $storedProducts = $this->getCartData('products');
        $result = new Collection;

//        $ids = array_unique(array_column($storedProducts, 'id'));
//
//
//        // todo: товары то без связей
//        $products = Product::enabled()
//            ->whereIn('id', $ids)
//            ->with(['image', 'prices', 'currentI18n', 'options'])
//            ->get();
//
//        foreach ($storedProducts as $storedProduct) {
//            $product = $products->where('id', $storedProduct['id'])->first();
//
//            if (is_null($product)) {
//                continue;
//            }
//
//            $cartProduct = app()->makeWith(CartProduct::class, [
//                'id'       => $storedProduct['id'],
//                'options'  => $storedProduct['options'],
//                'quantity' => $storedProduct['quantity'],
//                'product'  => $product
//            ]);
//
//            if ($cartProduct->isExist()) {
//                $result->push($cartProduct);
//            }
//        }


        foreach ($storedProducts as $storedProduct) {
            $result->push(app()->makeWith(CartProduct::class, [
                'productId'   => $storedProduct['productId'],
                'options'     => $storedProduct['options'],
                'quantity'    => $storedProduct['quantity'],
                'addedAt'     => $storedProduct['addedAt'],
                'updatedAt'   => $storedProduct['updatedAt'],
                'productData' => app()->makeWith(CartProductData::class, [
                    'data' => $storedProduct['productData']
                ])
            ]));
        }

        return $result;
    }

    protected function getPromoCode()
    {
        $promoCode = $this->getCartData('promoCode');

        if (is_null($promoCode)) {
            return null;
        }

        if ($promoCode instanceof PromoCode) {
            return $promoCode;
        }

        return app()->makeWith(PromoCode::class, [
            'codeName' => $promoCode
        ]);
    }
}

