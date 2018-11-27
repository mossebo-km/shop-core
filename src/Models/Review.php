<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;

use MosseboShopCore\Contracts\Models\HasMorphRelation as HasMorphRelationInterface;
use MosseboShopCore\Support\Traits\Models\HasMorphRelation;

abstract class Review extends BaseModel implements LikeableContract, HasMorphRelationInterface
{
    use Likeable, HasEnabledStatus, HasMorphRelation;

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
        'enabled',
        'created_at',
        'updated_at',
    ];

    protected $morphTypeName = 'review';

    public function item()
    {
        return $this->morphTo();
    }
}
