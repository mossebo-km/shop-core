<?php

namespace MosseboShopCore\Shop\Cart\Storage\Session;

use Illuminate\Session\SessionManager;

abstract class CartSessionConnector
{
    protected static $namespace = 'mossebo-cart';
    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    protected function get($key, $defaultValue)
    {
        return $this->session->get(static::makeStorageKey($key), $defaultValue);
    }

    protected function put($key, $value)
    {
        return $this->session->put(static::makeStorageKey($key), $value);
    }



    protected static function makeStorageKey($key)
    {
        return static::$namespace . '::' . $key;
    }
}