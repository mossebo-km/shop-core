<?php

return [
    'discount' => [
        'percent' => [
            'max_percent' => env('SHOP_PROMO_DISCOUNT_PERCENT_MAX_PERCENT', 20),
        ],

        'amount' => [
            'max_percent' => env('SHOP_PROMO_DISCOUNT_AMOUNT_MAX_PERCENT', 10)
        ]
    ],

    'conditions' => [
        'types' => [
            'min_summ',
            'product_expensive',
            'products_quantity',
//            'products_relation',
//            'categories_relation',
//            'styles_relation',
//            'rooms_relation',
//            'review_exist',
            'first_order',
//            'last_order_date',
        ]
    ]
];