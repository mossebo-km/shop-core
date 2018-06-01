<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

class PriceType extends BaseModelI18n
{
    protected $tableIdentif = 'PriceTypes';

    /**
     * Поле, через которое осуществляется связь с таблицей переводов.
     *
     * @var string
     */
    protected $translateRelationField = 'price_type_id';

    public function prices()
    {
        return $this->morphMany(Price::class, 'price_type_id');
    }
}