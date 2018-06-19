<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CountryRepository as CountryRepositoryContract;

class CountryRepository extends RamRepository implements CountryRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n',
    ];
}