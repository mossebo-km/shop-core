<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\LanguagesRepository as LanguagesRepositoryInterface;

class LanguagesRepository extends BaseRepository implements LanguagesRepositoryInterface
{
    public function default()
    {
        return $this->getCollection()->where('id', config('languages.default'))->first();
    }
}
