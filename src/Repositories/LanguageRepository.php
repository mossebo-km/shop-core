<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryContract;
use MosseboShopCore\Models\Language;

class LanguageRepository extends RamRepository implements LanguageRepositoryContract
{
    protected $model = Language::class;
}