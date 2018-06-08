<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\PriceTypeRepository as PriceTypeRepositoryContract;
use MosseboShopCore\Models\Shop\PriceType;

class PriceTypeRepository extends RamRepository implements PriceTypeRepositoryContract
{
    protected $model = PriceType::class;

    protected $modificators = [
        'i18n',
    ];
}