<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryInterface;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    public function default()
    {
        return $this->getCollection()->where('id', config('languages.default'))->first();
    }
}
