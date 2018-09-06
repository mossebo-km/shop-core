<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Repositories\Base\BaseRepository;
use MosseboShopCore\Contracts\Repositories\RoomRepository as RoomRepositoryContract;
use \Illuminate\Support\Collection;

abstract class SettingsRepository extends BaseRepository implements RoomRepositoryContract
{
    protected function filterByNamespace($namespace)
    {
        $namespace .= '-';

        return $this->getCollection()->reduce(function($carry, $item) use($namespace) {
            if (strpos($item->key, $namespace) === 0) {
                $item->key = str_replace($namespace, '', $item->key);
                $carry->push($item);
            }

            return $carry;
        }, new Collection());
    }

    public function notifySocials()
    {
        return $this->filterByNamespace('notify-social');
    }

    public function publicSocials()
    {
        return $this->filterByNamespace('public-social');
    }

    public function get($key)
    {
        $item = $this->getCollection()->where('key', $key)->first();

        return $item ? $item->value : null;
    }
}