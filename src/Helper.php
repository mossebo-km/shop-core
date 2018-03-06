<?php

namespace MosseboCM\MosseboShopCore;

use Cache;

class Helper
{
    public static function cached($key, $callback)
    {
        if (! ($value = Cache::get($key))) {
            $value = call_user_func($callback);
        }

        return $value;
    }
}
