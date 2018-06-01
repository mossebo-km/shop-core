<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\AttributeRepository as AttributeRepositoryContract;
use MosseboShopCore\Models\Shop\Attribute;

class AttributeRepository extends RamRepository implements AttributeRepositoryContract
{
    protected $model = Attribute::class;

    protected $modificators = [
        'i18n', 'currentI18n'
    ];

    protected function _withI18n($query)
    {
        return $query->with('i18n');
    }

    protected function _withCurrentI18n($query)
    {
        return $query->with('currentI18n');
    }

    protected function _getBaseQuery() {
        return $this->model::with(['options' => function ($query) {
            $query->with('currentI18n');
        }]);
    }
}
