<?php

namespace MosseboShopCore\Models\Shop\Room;

use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Support\Traits\Models\HasI18n;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;
use MosseboShopCore\Support\Traits\Models\HasProductCount;

use MosseboShopCore\Contracts\Models\HasMorphRelation as HasMorphRelationInterface;
use MosseboShopCore\Support\Traits\Models\HasMorphRelation;

abstract class Room extends BaseModel implements HasMorphRelationInterface
{
    use HasI18n, HasEnabledStatus, HasProductCount, HasMorphRelation;

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

    protected $morphTypeName = 'room';
}