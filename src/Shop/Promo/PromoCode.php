<?php

namespace MosseboShopCore\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Promo\PromoValidator as PromoValidatorInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class PromoCode implements PromoCodeInterface
{
    protected $resource = null;

    public function __construct($codeName)
    {
        $this->setResource($codeName);
    }

    public function setResource($codeName = ''): void
    {
        // установить в реализации
    }

    public function notExist(): bool
    {
        return is_null($this->resource);
    }

    public function getConditions(): Collection
    {
        return $this->resource->conditions;
    }

    public function notActual(): bool
    {
        if ($this->notExist()) {
            return true;
        }

        $currentTime = time();

        if ($this->date_start) {
            $timeStart = Carbon::createFromTimeString($this->date_start)->timestamp;

            if ($currentTime < $timeStart) {
                return false;
            }
        }

        if ($this->date_finish) {
            $timeFinish  = Carbon::createFromTimeString($this->date_finish)->timestamp;

            if ($currentTime > $timeFinish) {
                return false;
            }
        }

        if ($this->quantity === 0) {
            return false;
        }
    }

    public function validate(Cart $cart): PromoValidatorInterface
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