<?php

namespace MosseboShopCore\Elasticsearch\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class ProductIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'products';

    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [
            'analyzer' => [
                'default' => [
                    'tokenizer' => 'keyword',
                    'filter' => [
                        'lowercase',
                    ]
                ]
            ]
        ]
    ];
}
