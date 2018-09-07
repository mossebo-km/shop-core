<?php

namespace MosseboShopCore\Models\Shop\Room;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasProductCount;

abstract class Room extends BaseModel
{
    use HasI18n, HasEnabledStatus, HasProductCount;

    protected $tableKey = 'Rooms';
    protected $relationFieldName = 'room_id';

    protected $fillable = [
        'slug',
        'enabled',
        'position'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}