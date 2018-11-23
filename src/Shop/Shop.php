<?php

namespace MosseboShopCore\Shop;

use MosseboShopCore\Contracts\Shop\Shop as ShopInterface;

use Auth;
use MosseboShopCore\Shop\Shop\Traits\HasLanguage;
use MosseboShopCore\Shop\Shop\Traits\HasCurrency;
use MosseboShopCore\Shop\Shop\Traits\HasPriceTypes;
use MosseboShopCore\Contracts\Shop\Cart\Cart as CartInterface;
use MosseboShopCore\Contracts\Shop\Order\Order as OrderInterface;

abstract class Shop implements ShopInterface
{
    use HasLanguage, HasCurrency, HasPriceTypes;

    public function hasLanguage()
    {
        return true;
    }

    public function hasCurrency()
    {
        return true;
    }

    public function hasPriceTypes()
    {
        return true;
    }

    public function getAvailableProductOptionIds($productId)
    {
        return [];
    }

    public function call($callable, $params = null)
    {
        return app()->call($callable, $params);
    }

    public function make($className, $data = null)
    {
        if (is_array($data)) {
            return app()->makeWith($className, $data);
        }

        return app()->make($className);
    }

    public function makeCart($cartBuilderClassName, $data = null): CartInterface
    {
        $builder = $this->make($cartBuilderClassName, [
            'data' => $data
        ]);

        return $builder->getCart();
    }

    public function makeOrder($orderBuilderClassName, $data = null): OrderInterface
    {
        $builder = $this->make($orderBuilderClassName, [
            'data' => $data
        ]);

        return $builder->getOrder();
    }
}
