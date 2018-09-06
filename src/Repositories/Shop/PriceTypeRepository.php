<?php

namespace MosseboShopCore\Repositories\Shop;

use MosseboShopCore\Repositories\Base\BaseRepository;
use MosseboShopCore\Contracts\Repositories\PriceTypeRepository as PriceTypeRepositoryContract;

abstract class PriceTypeRepository extends BaseRepository implements PriceTypeRepositoryContract
{
    public function default()
    {
        return $this->getCollection()->where('default', 1)->first();
    }
}