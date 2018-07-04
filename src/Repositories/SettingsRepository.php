<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\RoomRepository as RoomRepositoryContract;
use \Illuminate\Support\Collection;

class SettingsRepository extends RamRepository implements RoomRepositoryContract
{
    protected $modificators = [
    ];

    protected function filterByNamespace($namespace)
    {
        $namespace .= '-';

        return $this->getCollection()->reduce(function($carry, $item) use($namespace) {
            if (strpos($namespace, $item->key) === 0) {
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