<?php

namespace MosseboShopCore\Shop\Cart;

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

    /**
     * Проверка промокода для корзины
     */
    protected function validate()
    {
        try {
            $this->checkIsUsed();
            $this->checkCurrency();
            $this->checkConditions();

            $this->status = 'success';
        }
        catch (PromoCheckException $exception) {
            $this->status = 'error';
            $this->errorMessage = $exception->getMessage();
        }
    }

    /**
     * Проверяет, вышел ли лимит использований кода для данного пользователя
     *
     * @throws PromoCheckException
     */
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

    /**
     * Проверка корзины на дополнительные условия
     *
     * @throws PromoCheckException
     */
    protected function checkConditions()
    {
        $conditions = $this->promoCode->getConditions();

        foreach ($conditions as $condition) {
            $className = str_replace('_', '', ucwords($condition->type, '_'));

            $condition = app()->make("\MosseboShopCore\Shop\Promo\Conditions\{$className}");

            if (! $condition->check($this->cart)) {
                throw new PromoCheckException(trans("shop.promo.errors.{$condition->type}"));
            }
        }
    }

    /**
     * Были ли обнаружены ошибки при валидации
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->status === 'error';
    }

    /**
     * Сообщение ошибки при неудачной валидации
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}