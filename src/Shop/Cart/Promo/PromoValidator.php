<?php

namespace MosseboShopCore\Shop\Cart\Promo;

use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoValidator as PromoValidatorInterface;
use MosseboShopCore\Contracts\Shop\Cart\Cart;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCode;
use MosseboShopCore\Contracts\Shop\Cart\Promo\PromoCondition;
use MosseboShopCore\Contracts\Models\Shop\Promo\PromoCondition as PromoConditionResourceInterface;
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
    protected function checkIsUsed(): void
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
     * Проверяет, совпдают ли валюты промокода и корзины
     *
     * @throws PromoCheckException
     */
    protected function checkCurrency(): void
    {
        if ($this->promoCode->amount || $this->promoCode->currency_code) {
            if ($this->promoCode->currency_code !== $this->cart->getCurrencyCode()) {
                throw new PromoCheckException(trans('shop.promo.errors.currency'));
            }
        }
    }

    /**
     * Проверка корзины на дополнительные условия
     *
     * @throws PromoCheckException
     */
    protected function checkConditions(): void
    {
        $conditionModels = $this->promoCode->getConditions();

        foreach ($conditionModels as $conditionModel) {
            $condition = $this->getConditionByType($conditionModel);

            if (is_null($condition)) {
                continue;
            }

            if (! $condition->check($this->cart)) {
                throw new PromoCheckException(trans("shop.promo.errors.{$conditionModel->type}", $condition->getParams()));
            }
        }
    }

    /**
     * Возвращает условие проверки промокода
     *
     * @param $type
     * @return PromoCondition|null
     */
    protected function getConditionByType(PromoConditionResourceInterface $promoCodeConditionModel): ?PromoCondition
    {
        $className = str_replace('_', '', ucwords($promoCodeConditionModel->type, '_'));

        return app()->makeWith("\\MosseboShopCore\\Shop\\Cart\\Promo\\Conditions\\{$className}", [
            'resource' => $promoCodeConditionModel
        ]);
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
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}