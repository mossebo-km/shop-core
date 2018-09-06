<?php

namespace MosseboShopCore\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Cache\Repository as CacheInterface;
use MosseboShopCore\Contracts\Repositories\Repository as RepositoryInterface;

/**
 * Занимается кэшированием выборок моделей, чтобы лишний раз не дергать базу данных.
 */

abstract class BaseRepository implements RepositoryInterface
{
    protected $storage = null;
    protected $collection = null;
    protected $cacheMinutes = null;

    public function __construct(CacheInterface $storage, int $cacheMinutes = null)
    {
        $this->storage = $storage;

        $this->cacheMinutes = is_null($cacheMinutes)
            ? config('shop.repositories.cache.minutes', 30)
            : $cacheMinutes;
    }

    /**
     * Получение коллекции данных с указанными модификаторами.
     * Данные кэшируются, и в следующий раз берутся из кэша.
     */
    public function getCollection(): Collection
    {
        if (is_null($this->collection)) {
            $this->collection = $this->storage->remember($this->getCacheKey(), $this->getCacheMinutes(), function() {
                return $this->getCollectionRaw();
            });
        }

        return $this->collection;
    }

    /**
     * Формирует запрос в базу
     */
    public function getCollectionRaw(): Collection
    {
        return new Collection;
    }

    /**
     * Чистка кэша
     */
    public function clearCache(): void
    {
        $this->storage->forget($this->getCacheKey());
    }

    /**
     * Формирование ключа для кэша на основе модификаторов
     */
    protected function getCacheKey()
    {
        return "repository::{$this->model}";
    }

    /**
     * Возвращает время, на которое надо кэшировать коллекцию
     */
    protected function getCacheMinutes()
    {
        return $this->cacheMinutes;
    }

    public function __call($name, Array $params)
    {
        $collection = $this->getCollection();

        return call_user_func_array([$collection, $name], $params);
    }
}