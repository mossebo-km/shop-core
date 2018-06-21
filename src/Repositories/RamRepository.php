<?php

namespace MosseboShopCore\Repositories;

use MosseboShopCore\Contracts\Repositories\RamRepository as RamRepositoryContract;

class RamRepository implements RamRepositoryContract {

    protected $collection = null;

    protected $cacheKey = null;

    protected $model = null;

    protected $cacheMinutes = null;

    protected $modificators = [];

    protected $collectionModificators = [];

    public function __construct($model)
    {
        $this->model = $model;

        if (is_null($this->cacheKey)) {
            $this->cacheKey = $this->model . 'RepositoryCache';
        }

        $this->modificators[] = 'enabled';
    }

    /**
     * Получение коллекции данных с указанными модификаторами.
     * Данные кэшируются, и в следующий раз берутся из кэша.
     */
    public function getCollection($modificators = [])
    {
        if (! is_array($modificators)) {
            $modificators = [$modificators];
        }

        $newModificators = [];
        foreach ($modificators as $modificatorName) {
            if (in_array($modificatorName, $this->modificators)) {
                $newModificators[] = $modificatorName;
            }
        }

        if (count(array_intersect($this->collectionModificators, $newModificators)) !== count($newModificators)) {
            $this->collection = null;
            $this->collectionModificators = $newModificators;
        }

        if (is_null($this->collection)) {
            $this->collection = $this->_getCachedCollection();
        }

        return $this->collection;
    }

    /**
     * Добавляет 'enabled' к модификаторам и возвращает getCollection
     */
    public function enabled($modificators = [])
    {
        if (! is_array($modificators)) {
            $modificators = [$modificators];
        }

        $modificators[] = 'enabled';

        return $this->getCollection($modificators);
    }

    protected function _enabledQueryModificator($query)
    {
        return $query->where('enabled', 1);
    }

    /**
     * Возвращает имени класса модели
     */
    public function getModelClassName()
    {
        return $this->model;
    }

    /**
     * Формирует базовый запрос в базу
     */
    protected function _getBaseQuery()
    {
        return $this->model::orderBy('position', 'asc');
    }

    /**
     * Формирует колекцию, с учетом модификаторов
     */
    protected function _getCollection()
    {
        $query = $this->_getBaseQuery();

        foreach ($this->collectionModificators as $modificatorName) {
            $methodName = '_' . lcfirst($modificatorName) . 'QueryModificator';

            if (method_exists($this, $methodName)) {
                $query = $this->$methodName($query);
            }
            else {
                $query = $query->with($modificatorName);
            }
        }

        return $query->get();
    }

    /**
     * Формирование ключа для кэша на основе модификаторов
     */
    protected function _getCacheKey()
    {
        $cacheKey = $this->cacheKey;

        foreach ($this->collectionModificators as $modificatorName) {
            $cacheKey .= $modificatorName;
        }

        return $cacheKey;
    }

    /**
     * Возвращает время, на которое надо кэшировать коллекцию
     */
    protected function _getCacheMinutes()
    {
        return isset($this->cacheMinutes) ? $this->cacheMinutes : config('repository.cache.minutes', 30);
    }

    /**
     * Сохраняет коллекцию в кэш.
     */
    protected function _getCachedCollection()
    {
        return \Cache::remember($this->_getCacheKey(), $this->_getCacheMinutes(), function() {
            return $this->_getCollection();
        });
    }

    /**
     * Чистка кэша
     */
    public function clearCache()
    {
        $this->collection = null;

        if (count($this->modificators) === 0) {
            \Cache::forget($this->_getCacheKey());
            return;
        }

        $this->clearCacheDeep();
    }

    // todo: переделать это замечательное творение
    /**
     * Чистка кэша с учетом всех модификаторов
     */
    protected function clearCacheDeep($modificatorName = false, $modificators = [], $count = 0)
    {
        if (! $modificatorName) {
            $modificatorName = $this->modificators[0];
            $index = 0;
        }
        else {
            $index = array_search($modificatorName, $this->modificators);
        }

        if ($index < count($this->modificators) - 1) {
            $this->clearCacheDeep($this->modificators[$index + 1], $modificators, $count);

            $modificators[] = $modificatorName;
            $this->clearCacheDeep($this->modificators[$index + 1], $modificators, $count);
        }

        $this->collectionModificators = $modificators;
        \Cache::forget($this->_getCacheKey());

        $modificators[] = $modificatorName;
        $this->collectionModificators = $modificators;
        \Cache::forget($this->_getCacheKey());
    }

    public function __call($name, Array $params)
    {
        $collection = $this->getCollection();

        return call_user_func_array([$collection, $name], $params);
    }
}