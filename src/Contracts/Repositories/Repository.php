<?php

namespace MosseboShopCore\Contracts\Repositories;

use Illuminate\Support\Collection;

interface Repository
{
    /**
     * Возвращает закэшированные данные.
     *
     * @return Illuminate\Support\Collection
     */
    public function getCollection(): Collection;

    /**
     * Возвращает данные, игнорируя кэширование.
     * Так же является источником данных для getCollection.
     *
     * @return Illuminate\Support\Collection
     */
    public function getCollectionRaw(): Collection;

    /**
     * Чистит кэш репозитория.
     */
    public function clearCache(): void;
}