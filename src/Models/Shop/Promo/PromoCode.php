<?php

namespace MosseboShopCore\Models\Shop\Promo;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Contracts\Shop\Order\Order;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode as PromoCodeInterface;
use MosseboShopCore\Contracts\Shop\Order\OrderProduct;
use MosseboShopCore\Exceptions\PromoCheckException;


abstract class PromoCode extends BaseModel implements PromoCodeInterface
{
    protected $tableIdentif = 'PromoCodes';
    protected $relationFieldName = 'promo_code_id';

    public function apply(Order & $order): void
    {
        $promoType = $this->getType();

        switch ($promoType) {
            case 'amount':
                $order->setAmountDiscount($this->amount, $this->currency_code, $this->percent, true);
                break;

            case 'percent':
                $order->setPercentDiscount($this->percent, true);
                break;
        }
    }

    protected function getType(): string
    {
        if (! $this->amount || $this->currency_code) {
            return 'percent';
        }

        return 'amount';
    }

    public function canBeApplyedByOrder(Order $order): bool
    {
        $promoType = $this->getType();

        $currentTime = time();
        $timeStart   = Carbon::createFromTimeString($this->date_start)->timestamp;
        $timeFinish  = Carbon::createFromTimeString($this->date_finish)->timestamp;

        // todo: переводы

        if ($currentTime < $timeStart) {
            throw new \PromoCheckException(trans('shop.promo.time_has_not_come'));
        }

        if ($currentTime > $timeFinish) {
            throw new \PromoCheckException(trans('shop.promo.time_is_over'));
        }

        if ($this->quantity === 0) {
            throw new \PromoCheckException(trans('shop.promo.no_longer_available'));
        }

        $products = $order->getProducts();

        if ($products->count() === 0) {
            throw new \PromoCheckException(trans('shop.promo.cart_is_empty'));
        }


    }
}
