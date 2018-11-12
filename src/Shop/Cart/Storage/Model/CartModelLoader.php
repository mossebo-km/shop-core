<?php

namespace MosseboShopCore\Shop\Cart\Storage\Model;

use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Cart\CartLoader;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;

class CartModelLoader implements CartLoader
{
    protected $cartData = null;

    public function __construct($data)
    {
        $this->cartData = $data;
    }

    public function getCart(): CartInterface
    {
        return app()->makeWith(CartInterface::class, $this->getCartContent());
    }

    public function getCartContent()
    {
        return [
            'user'         => $this->cartData->user,
            'products'     => $this->getProducts(),
            'currencyCode' => $this->cartData->currency_code,
            'promoCode'    => $this->getPromoCode(),
            'createdAt'    => time(),
            'updatedAt'    => time(),
        ];
    }

    public function getProducts(): Collection
    {
        $products = new Collection;

        if ($this->cartData->relationNotEmpty('orderProducts')) {
            foreach ($this->cartData->orderProducts as $orderProduct) {
                if ($orderProduct->options->count() > 0) {
                    $options = array_column($orderProduct->options->toArray(), 'option_id');
                }
                else {
                    $options = [];
                }

                $params = json_decode($orderProduct->params, true);

                $params['options'] = Shop::getAvailableProductOptionIds($orderProduct->product_id);

                $cartProduct = app()->make(CartProduct::class, [
                    'productId'   => $orderProduct->product_id,
                    'options'     => $options,
                    'quantity'    => $orderProduct->quantity,
                    'addedAt'     => $orderProduct->created_at,
                    'updatedAt'   => $orderProduct->updated_at,
                    'productData' => app()->make(CartProductData::class, ['data' => $params]),
                ]);

                $products->push($cartProduct);
            }
        }

        return $products;
    }

    protected function getPromoCode()
    {
        if (! $this->cartData->relationNotEmpty('promoUse')) {
            return null;
        }

        return app()->makeWith(PromoCode::class, [
            'codeName' => $this->cartData->promoUse->promo_code_id
        ]);

    }
}

