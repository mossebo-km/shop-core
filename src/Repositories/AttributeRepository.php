<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\AttributeRepository as AttributeRepositoryContract;

class AttributeRepository extends RamRepository implements AttributeRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];

    protected function _getBaseQuery() {
        return $this->model::with([
            'options' => function ($query) {
                $query->with('currentI18n')->orderBy('position', 'asc');
            }
        ])->orderBy('position', 'asc');
    }
}
