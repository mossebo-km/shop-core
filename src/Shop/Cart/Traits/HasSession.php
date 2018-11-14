<?php

namespace MosseboShopCore\Shop\Cart\Traits;

use Session;

trait HasSession
{
    protected static $namespace = 'mossebo-cart';

    protected function get($key, $defaultValue = null)
    {
        return Session::get(static::makeStorageKey($key), $defaultValue);
    }

    protected function put($key, $value)
    {
        return Session::put(static::makeStorageKey($key), $value);
    }

    protected function forget($key)
    {
        return Session::forget(static::makeStorageKey($key));
    }

    protected static function makeStorageKey($key)
    {
        return implode('::', [
            static::$namespace,
            $key,
            Session::getId()
        ]);
    }
}
