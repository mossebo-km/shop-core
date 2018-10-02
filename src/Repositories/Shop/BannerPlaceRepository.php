<?php

namespace MosseboShopCore\Repositories\Shop;

use MosseboShopCore\Repositories\Base\BaseRepository;
use MosseboShopCore\Contracts\Repositories\BannerPlaceRepository as BannerPositionRepositoryContract;

abstract class BannerPlaceRepository extends BaseRepository implements BannerPositionRepositoryContract
{
    public function byType($type)
    {
        return $this->getCollection()->where('type', $type);
    }
}
