<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\PriceTypeRepository as PriceTypeRepositoryContract;
use MosseboShopCore\Models\PriceType;

class PriceTypeRepository extends RamRepository implements PriceTypeRepositoryContract
{
    protected $model = PriceType::class;

    protected function _getBaseQuery() {
        return $this->model::with('i18n');
    }
}