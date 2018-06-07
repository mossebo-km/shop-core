<?php

namespace MosseboShopCore\Contracts\Repositories;

interface RoomRepository extends RamRepository
{
    public function getTree($modificators);
}