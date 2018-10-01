<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasMorphRelation
{
    public function getMorphTypeName(): string
    {
        return $this->morphTypeName;
    }
}