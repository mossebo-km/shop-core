<?php

namespace MosseboShopCore\Models\Shop\Room;

use MosseboShopCore\Models\Base\BaseModel;

abstract class RoomProduct extends BaseModel
{
    protected $tableKey = 'RoomProducts';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'room_id',
        'product_id'
    ];

    public $timestamps = false;
}
