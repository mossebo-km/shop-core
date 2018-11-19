<?php

namespace MosseboShopCore\Shop\Cart\Builders;

use Shop;
use Auth;
use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Shop\Cart\CartProduct as CartProductInterface;
use MosseboShopCore\Contracts\Shop\Cart\CartProductData as CartProductDataInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Shop\Cart\Traits\HasSession;

class SessionCartLoader extends AbstractCartBuilder
{
    use HasSession;

    public function __construct()
    {
        $this->cartData = $this->get('cart');

        if (empty($this->cartData)) {
            $this->cartData = $this->makeEmptyCartData();
        }
    }

    protected function makeEmptyCartData()
    {
        $defaultPromo = Shop::getDefaultPromoCode();

        return [
            'products' => [],
            'currencyCode' => Shop::getCurrentCurrencyCode(),
            'promoCode'    => $defaultPromo ? $defaultPromo : null,
        ];
    }

    protected function getPriceTypeId(): int
    {
        if ($priceTypeId = $this->getCartData('priceTypeId')) {
            return $priceTypeId;
        }

        return parent::getPriceTypeId();
    }

    protected function getCurrencyCode(): ?string
    {
        return $this->getCartData('currencyCode');
    }

    protected function getProducts(): Collection
    {
        $products = new Collection;

        foreach ($this->getCartData('products') as $storedProduct) {
            $product = Shop::make(CartProductInterface::class, [
                'productId' => $storedProduct['product_id'],
                'options'   => $storedProduct['options'],
                'quantity'  => $storedProduct['quantity'],
            ]);

            $product->setBasePriceTypeId($storedProduct['base_price_type_id']);
            $product->setFinalPriceTypeId($storedProduct['final_price_type_id']);
            $product->setCurrencyCode($storedProduct['currency_code']);
            $product->setAddedAtTimestamp($storedProduct['created_at']);
            $product->setUpdatedAtTimestamp($storedProduct['updated_at']);

            $product->setProductData(Shop::make(CartProductDataInterface::class, [
                'data' => $storedProduct['params']
            ]));

            $products->push($product);
        }

        return $products;
    }

    protected function getPromoCode(): ?PromoCodeInterface
    {
        $promoCodeName = $this->getCartData('promoCode');

        if (is_null($promoCodeName)) {
            return null;
        }

        if ($promoCodeName instanceof PromoCodeInterface) {
            return $promoCodeName;
        }

        $promoCode = Shop::make(PromoCodeInterface::class, [
            'codeName' => $promoCodeName
        ]);

        return $promoCode->notExist() ? null : $promoCode;
    }

    protected function getCreatedAt()
    {
        return $this->getCartData('createdAt') ?: time();
    }

    protected function getUpdatedAt()
    {
        return $this->getCartData('updatedAt') ?: time();
    }
}
