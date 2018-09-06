<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Repositories\Base\BaseRepository;
use MosseboShopCore\Contracts\Repositories\LanguageRepository as LanguageRepositoryInterface;

abstract class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    public function default()
    {
        return $this->getCollection()->where('default', 1)->first();
    }
}
