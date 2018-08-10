<?php

namespace MosseboShopCore\Elasticsearch\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class CityIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'cities';

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