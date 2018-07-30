<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\DeliveryTypeRepository as DeliveryTypeRepositoryContract;

class DeliveryTypeRepository extends RamRepository implements DeliveryTypeRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];
}