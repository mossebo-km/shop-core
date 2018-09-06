<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

abstract class Review extends BaseModel implements LikeableContract
{
    use Likeable, HasEnabledStatus;

    protected $tableKey = 'Reviews';

    protected $fillable = [
        'item_type',
        'item_id',
        'language_code',
        'user_id',
        'rate',
        'advantages',
        'disadvantages',
        'comment',
        'usage_time',
        'confirmed',
        'enabled'
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
