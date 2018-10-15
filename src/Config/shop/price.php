<?php

return [
    'types' => [
        'default'    => env('SHOP_PRICE_TYPE_DEFAULT', 7),
        'franchisee' => env('SHOP_PRICE_TYPE_FRANCHISEE', 3),
        'old'        => env('SHOP_PRICE_TYPE_OLD', 1),
        'sale'       => env('SHOP_PRICE_TYPE_SALE', 6),
    ]
];