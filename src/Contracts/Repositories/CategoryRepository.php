<?php

namespace MosseboShopCore\Contracts\Repositories;

interface CategoryRepository extends RamRepository
{
    public function getTree($modificators);
}