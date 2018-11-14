<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Shop;
use Auth;
use Cache;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;

use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Customer as CustomerInterface;


class ModelCartLoader extends AbstractCartBuilder
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

                $product = Shop::make(CartProductInterface::class, [
                    'productId'        => $orderProduct->product_id,
                    'options'          => $options,
                    'quantity'         => $orderProduct->quantity,
                ]);

                $product->setBasePriceTypeId($orderProduct->base_price_type_id);
                $product->setFinalPriceTypeId($orderProduct->final_price_type_id);
                $product->setAddedAtTimestamp($orderProduct->created_at);
                $product->setUpdatedAtTimestamp($orderProduct->updated_at);

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
        if (! $this->cartData->relationNotEmpty('promoUse')) {
            return null;
        }

        return Shop::make(PromoCodeInterface::class, [
            'codeName' => $this->cartData->promoUse->promo_code_id
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

