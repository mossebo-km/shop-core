<?php

namespace MosseboShopCore\Contracts\Repositories;

interface RamRepository
{
    public function getCollection();
    public function clearCache();
}
