<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CurrencyRepository as CurrencyRepositoryContract;

class CurrencyRepository extends RamRepository implements CurrencyRepositoryContract
{
    protected function _getBaseQuery() {
        return $this->model::orderBy('position', 'asc');
    }
}