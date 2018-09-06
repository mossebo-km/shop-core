<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\OrderStatusRepository as OrderStatusRepositoryContract;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];
}