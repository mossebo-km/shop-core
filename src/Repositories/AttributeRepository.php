<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\AttributeRepository as AttributeRepositoryContract;

class AttributeRepository extends RamRepository implements AttributeRepositoryContract
{
    protected $model = \App\Models\Currency::class;

    protected function _getBaseQuery() {
        return $this->model::with(['options' => function ($query) {
            $query->with('currentI18n');
        }]);
    }
}
