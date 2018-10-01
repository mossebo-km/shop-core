<?php

namespace MosseboShopCore\Contracts\Models;

interface HasMorphRelation
{
    public function getMorphTypeName(): string;
}