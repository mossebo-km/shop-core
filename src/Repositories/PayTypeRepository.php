<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\PayTypeRepository as PayTypeRepositoryContract;

class PayTypeRepository extends RamRepository implements PayTypeRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];
}