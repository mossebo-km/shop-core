<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryContract;

class LanguageRepository extends BaseRepository implements LanguageRepositoryContract
{
    protected $modificators = [
        'currency',
    ];

    public function default()
    {
        return $this->enabled()->where('default', 1)->first();
    }
}
