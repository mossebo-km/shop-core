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
            'filter' => [
                'shop_synonym_filter' => [
                    'type' => 'synonym',
                    'synonyms' => [
                        'стул, табурет, сиденье',
                        'вигвам, шалаш',
                        'светильник, бра, торшер, лампа',
                    ]
                ]
            ],

            'analyzer' => [
                'default' => [
                    'tokenizer' => 'keyword',
                    'filter' => [
                        'lowercase',
                        'shop_synonym_filter'
                    ]
                ]
            ]
        ]
    ];
}