<?php

namespace MosseboShopCore\Contracts\Repositories;

interface CategoryRepository extends Repository
{
    public function getTree($modificators);
}