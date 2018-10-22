<?php

namespace MosseboShopCore\Shop\Cart\Promo;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Price;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoValidator as PromoValidatorInterface;
use MosseboShopCore\Support\Traits\HasResource;

abstract class PromoCode implements PromoCodeInterface
{
    use HasResource;

    public function __construct($codeName)
    {
        if ($codeName instanceof Model) {
            $this->resource = $codeName;
        }
        else {
            $this->setResource($codeName);
        }
    }

    public function setResource($codeName = ''): void
    {
        // установить в реализации
    }

    public function getName(): string
    {
        return $this->resource->name;
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
        return app()->makeWith(PromoValidator::class, [
            'promoCode' => $this,
            'cart' => $cart
        ]);
    }

    public function apply(Price $price): Price
    {
        $price = clone $price;

        $price->minus($this->getDiscountPrice($price));

        return $price;
    }

    public function getDiscountPrice(Price $price): Price
    {
        $codeType = $this->getType();

        switch ($codeType) {
            case 'amount':
                $discountValue = $this->amountTypeDiscountValue($price);
                break;

            case 'percent':
                $discountValue = $this->percentTypeDiscountValue($price);
                break;
        }

        $discountValue = round($discountValue);

        $price = clone $price;
        $price->setValue($discountValue);

        return $price;
    }

    public function getType()
    {
        if ($this->resource->amount && $this->resource->currency_code) {
            return 'amount';
        }

        return 'percent';
    }

    protected function amountTypeDiscountValue(Price $price): float
    {
        $discountValue = $price->getValue() * $this->resource->percent / 100;

        return min($this->resource->amount, $discountValue);
    }

    protected function percentTypeDiscountValue(Price $price): float
    {
        return $price->getValue() * $this->resource->percent / 100;
    }
}