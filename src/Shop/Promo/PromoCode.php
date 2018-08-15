<?php

namespace MosseboShopCore\Shop\Cart;

use MosseboShopCore\Contracts\Shop\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Promo\PromoValidator as PromoValidatorInterface;

abstract class PromoCode implements PromoCodeInterface
{
    protected $model;

    public function __construct($codeName)
    {
        $this->model = $this->getModel($codeName);
    }

    public function notExist(): bool
    {
        return is_null($this->model);
    }

    public function notActual(): bool
    {
        if ($this->notExist()) {
            return true;
        }

        $timeStart   = Carbon::createFromTimeString($this->date_start)->timestamp;
        $timeFinish  = Carbon::createFromTimeString($this->date_finish)->timestamp;
        $currentTime = time();

        if ($currentTime < $timeStart) {
            return false;
        }

        if ($currentTime > $timeFinish) {
            return false;
        }

        if ($this->quantity === 0) {
            return false;
        }
    }

    public function canBeApplyedByCart(Cart $cart): PromoValidatorInterface
    {
        return new PromoValidator($this, $cart);
    }

    /**
     * Determine if an attribute exists on the resource.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->resource->{$key});
    }

    /**
     * Unset an attribute on the resource.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->resource->{$key});
    }

    /**
     * Dynamically get properties from the underlying resource.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->resource->{$key};
    }

    /**
     * Dynamically pass method calls to the underlying resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->resource->{$method}(...$parameters);
    }
}