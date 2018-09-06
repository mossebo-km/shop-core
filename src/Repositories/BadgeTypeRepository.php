<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\BadgeTypeRepository as BadgeTypeRepositoryContract;

class BadgeTypeRepository extends BaseRepository implements BadgeTypeRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];
}
