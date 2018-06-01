<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CurrencyRepository as CurrencyRepositoryContract;
use MosseboShopCore\Models\Shop\Currency;

class CurrencyRepository extends RamRepository implements CurrencyRepositoryContract
{
    protected $model = Currency::class;

    protected function _getBaseQuery() {
        return $this->model::orderBy('position', 'asc');
    }
}