<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\PriceTypeRepository as PriceTypeRepositoryContract;

class PriceTypeRepository extends BaseRepository implements PriceTypeRepositoryContract
{
    protected $modificators = [
        'i18n',
    ];
}