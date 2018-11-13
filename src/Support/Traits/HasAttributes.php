<?php

namespace MosseboShopCore\Support\Traits;

trait HasAttributes
{
    protected $attributes = [];

    public function getAttribute($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    public function fill(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }
}