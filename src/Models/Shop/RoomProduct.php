<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class RoomProduct extends BaseModel
{
    protected $tableIdentif = 'RoomProducts';

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
