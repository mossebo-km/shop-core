<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;

class DatabaseCartLoader extends AbstractCartBuilder
{
    protected $cartData = null;

    public function __construct($data)
    {
        $this->cartData = $data;

        if (empty($this->cartData)) {
            $this->cartData = $this->makeEmptyCartData();
        }

        dd('a');
    }

    protected function makeEmptyCartData()
    {
        return [
            'user' => Auth::user(),
            'products' => [],
            'currency_code' => Shop::getCurrentCurrencyCode(),
            'promoCode' => Shop::getDefaultPromoCode() ?: null,
        ];
    }

    protected function getCustomer(): ?CustomerInterface
    {
        return $this->getCartData('user');
    }

    protected function getProducts(): Collection
    {
        $products = new Collection;

        if ($cartProducts = $this->getCartData('products')) {
            $priceTypeId = $this->getCustomer()->getPriceTypeId();
            $currencyCode = $this->getCurrencyCode();

            foreach ($cartProducts as $cartProduct) {
                if ($cartProduct->options->count() > 0) {
                    $options = array_column($cartProduct->options->toArray(), 'option_id');
                }
                else {
                    $options = [];
                }

                $params = json_decode($cartProduct->params, true);
                $params['options'] = Shop::getAvailableProductOptionIds($cartProduct->product_id);

                $product = Shop::make(CartProductInterface::class, [
                    'productId' => $cartProduct->product_id,
                    'quantity'  => $cartProduct->quantity,
                    'options'   => $options,
                ]);

                $product->setCurrencyCode($currencyCode);
                $product->setBasePriceTypeId($priceTypeId);
                $product->setAddedAtTimestamp($cartProduct->created_at->timestamp);
                $product->setUpdatedAtTimestamp($cartProduct->updated_at->timestamp);

                $product->setProductData(
                    Shop::make(CartProductDataInterface::class, ['data' => $params])
                );

                $products->push($product);
            }
        }

        return $products;
    }

    protected function getCurrencyCode(): ?string
    {
        return $this->getCartData('currency_code');
    }

    protected function getPromoCode(): ?PromoCodeInterface
    {
        if (! ($promoCode = $this->getCartData('promoCode'))) {
            return null;
        }

        return Shop::make(PromoCodeInterface::class, [
            'codeName' => $promoCode->id
        ]);
    }

    protected function getCreatedAt()
    {
        return $this->getCartData('created_at');
    }

    protected function getUpdatedAt()
    {
        return $this->getCartData('updated_at');
    }
}

