<?php

namespace MosseboShopCore\Shop\Order;

use MosseboShopCore\Contracts\Shop\Promo\PromoValidator as PromoValidatorInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Promo\PromoCode;
use MosseboShopCore\Exceptions\PromoCheckException;

class PromoValidator implements PromoValidatorInterface
{
    protected $cart;
    protected $promoCode;
    protected $status;
    protected $errorMessage;

    public function __construct(PromoCode $promoCode, Cart $cart)
    {
        $this->cart = $cart;
        $this->promoCode = $promoCode;

        $this->validate();
    }

    protected function validate()
    {
        try {
            $this->checkIsUsed();


            $this->status = 'success';
        }
        catch (PromoCheckException $exception) {
            $this->status = 'error';
            $this->errorMessage = $exception->getMessage();
        }
    }

    protected function checkIsUsed()
    {
        if (! $this->cart->hasUser()) {
            return;
        }

        $user = $this->cart->getUser();

        $usesNum = $user->getPromoCodeUsesNum($this->promoCode->id);

        // Если промокод можно использовать только раз для аккаунта и кол-во использований не равно нулю
        if ($this->promoCode->once && $usesNum > 0) {
            throw new PromoCheckException(trans('shop.promo.errors.used'));
        }

        // Если промокод может использоваться для каждого пользователя несколько раз
        // и количество использований для 1 человека уже превысило возможный лимит
        if ($this->promoCode->user_related && $this->promoCode->quantity <= $usesNum) {
            throw new PromoCheckException(trans('shop.promo.errors.used'));
        }
    }


    public function hasError(): bool
    {
        return $this->status === 'error';
    }

    public function getMessage(): string
    {
        return $this->errorMessage;
    }
}