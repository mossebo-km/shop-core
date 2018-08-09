<?php

namespace MosseboShopCore\Models;

use MosseboShopCore\Models\Base\BaseModel;
use ScoutElastic\Searchable;
use MosseboShopCore\Elasticsearch\Configurators\CityIndexConfigurator;

abstract class City extends BaseModel
{
    use Searchable;

    protected $tableIdentif = 'Cities';

    protected $indexConfigurator = CityIndexConfigurator::class;
}
