<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryContract;

class LanguageRepository extends RamRepository implements LanguageRepositoryContract
{
    protected $model = \App\Models\Language::class;
}