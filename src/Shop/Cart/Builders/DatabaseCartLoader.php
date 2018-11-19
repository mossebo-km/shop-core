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
    }

    protected function getCustomer(): ?CustomerInterface
    {
        return $this->cartData->user;
    }

    protected function getProducts(): Collection
    {
        $products = new Collection;

        if ($this->cartData->relationNotEmpty('products')) {
            foreach ($this->cartData->products as $cartProduct) {
                if ($cartProduct->options->count() > 0) {
                    $options = array_column($cartProduct->options->toArray(), 'option_id');
                }
                else {
                    $options = [];
                }

                $params = json_decode($cartProduct->params, true);

                $params['options'] = Shop::getAvailableProductOptionIds($cartProduct->product_id);

                $product = Shop::make(CartProductInterface::class, [
                    'productId'        => $cartProduct->product_id,
                    'options'          => $options,
                    'quantity'         => $cartProduct->quantity,
                ]);

                $product->setCurrencyCode($this->getCurrencyCode());
                $product->setBasePriceTypeId($cartProduct->base_price_type_id);
                $product->setFinalPriceTypeId($cartProduct->final_price_type_id);
                $product->setAddedAtTimestamp($cartProduct->created_at);
                $product->setUpdatedAtTimestamp($cartProduct->updated_at);

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
        return $this->cartData->currency_code;
    }

    protected function getPromoCode(): ?PromoCodeInterface
    {
        if (! $this->cartData->relationNotEmpty('promoCode')) {
            return null;
        }

        return Shop::make(PromoCodeInterface::class, [
            'codeName' => $this->cartData->promoCode
        ]);
    }

    protected function getCreatedAt()
    {
        return $this->cartData->created_at;
    }

    protected function getUpdatedAt()
    {
        return $this->cartData->updated_at;
    }
}

