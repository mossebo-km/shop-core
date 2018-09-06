<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\CityRepository as CityRepositoryContract;

class CityRepository extends BaseRepository implements CityRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n',
    ];
}