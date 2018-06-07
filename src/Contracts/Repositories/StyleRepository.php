<?php

namespace MosseboShopCore\Contracts\Repositories;

interface StyleRepository extends RamRepository
{
    public function getTree($modificators);
}