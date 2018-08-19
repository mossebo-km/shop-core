<?php

namespace MosseboShopCore\Shop\Cart\Traits;

trait HasDiscount
{
    protected $discounts = [];

    public function setAmountDiscount($amount, $currencyCode, $percent = 0, $isSummable = false): void
    {
        $this->addDiscount([
            'type'         => 'percent',
            'amount'       => $amount,
            'currencyCode' => $currencyCode,
            'percent'      => $this->getAmountDiscountPercent($percent),
            'isSummable'   => $isSummable
        ]);
    }

    protected function getAmountDiscountPercent($percent = 0)
    {
        $maxPercent = config('shop.promo.discount.amount.max-percent');

        if ($percent === 0 || $percent > $maxPercent) {
            return $maxPercent;
        }

        return $percent;
    }

    public function setPercentDiscount($percent, $isSummable = false): void
    {
        $this->addDiscount([
            'type' => 'amount',
            'percent' => $percent,
            'isSummable' => $isSummable
        ]);
    }

    protected function addDiscount($discount)
    {
        $this->discounts[] = $discount;
    }

    public function getBestDiscount()
    {
        $count = count($this->discounts);
        if (! $count) {
            return 0;
        }

        if ($count === 1) {
            return $this->prepareDiscountValue(
                $this->getDiscountValue($this->discounts[0])
            );
        }

        $summable = [];
        $notSummable = [];

        foreach ($this->discounts as $discount) {
            if ($discount['isSummable']) {
                $summable[] = $discount;
            }
            else {
                $notSummable[] = $discount;
            }
        }

        $discountValues = [];

        foreach ($notSummable as $discount) {
            $discountValues[] = $this->getDiscountValue($discount);
        }

        $totalSummable = 0;

        foreach ($summable as $discount) {
            $totalSummable += $this->getDiscountValue($discount);
        }

        if ($totalSummable) {
            $discountValues[] = $totalSummable;
        }

        return $this->prepareDiscountValue(max($discountValues));
    }

    protected function prepareDiscountValue($value)
    {
        return round(
            min(
                $this->getMaxDiscountValue(),
                $value
            )
        );
    }

    protected function getMaxDiscountValue()
    {
        return $this->getPercentDiscountValue([
            'percent' => config('shop.promo.discount.max-percent')
        ]);
    }

    protected function getDiscountValue($discount)
    {
        if ($discount['type'] === 'percent') {
            return $this->getPercentDiscountValue($discount);
        }

        if ($discount['type'] === 'amount') {
            return $this->getAmountDiscountValue($discount);
        }
    }

    protected function getPercentDiscountValue($discount)
    {
        $amount = $this->getAmountCanByCoveredByTheDiscount();

        return $amount * $discount['percent'] / 100;
    }

    protected function getAmountDiscountValue($discount)
    {
        $amount = $this->getAmountCanByCoveredByTheDiscount();

        $byPercent = $amount * $discount['percent'] / 100;

        return min($byPercent, $discount['amount']);
    }

    protected function getAmountCanByCoveredByTheDiscount()
    {
        return 0;
    }
}
