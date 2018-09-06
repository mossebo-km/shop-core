<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

abstract class RoomI18n extends BaseModel
{
    protected $tableKey = 'RoomsI18n';

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'room_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = false;
}
