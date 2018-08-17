<?php

namespace MosseboShopCore\Shop\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Promo\PromoValidator as PromoValidatorInterface;
use MosseboShopCore\Support\Traits\HasResource;
use Illuminate\Database\Eloquent\Collection;


abstract class PromoCode implements PromoCodeInterface
{
    use HasResource;

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
                return true;
            }
        }

        if ($this->date_finish) {
            $timeFinish  = Carbon::createFromTimeString($this->date_finish)->timestamp;

            if ($currentTime > $timeFinish) {
                return true;
            }
        }

        if ($this->quantity === 0) {
            return true;
        }

        return false;
    }

    public function validate(Cart $cart): PromoValidatorInterface
    {
        return new PromoValidator($this, $cart);
    }
}