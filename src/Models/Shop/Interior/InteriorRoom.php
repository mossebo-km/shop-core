<?php

namespace MosseboShopCore\Models\Shop\Interior;

use MosseboShopCore\Models\Base\BaseModel;

abstract class InteriorRoom extends BaseModel
{
    protected $tableKey = 'InteriorRooms';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'interior_id',
        'room_id',
    ];

    public $timestamps = false;
}
