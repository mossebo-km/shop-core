<?php

namespace MosseboShopCore\Elasticsearch\Configurators;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class ProductIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'mossebo-shop';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}
