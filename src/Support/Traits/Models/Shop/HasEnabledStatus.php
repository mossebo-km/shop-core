<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasEnabledStatus
{
    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }
}