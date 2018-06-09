<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryContract;

class LanguageRepository extends RamRepository implements LanguageRepositoryContract
{
    protected $modificators = [
        'currency',
    ];
}
