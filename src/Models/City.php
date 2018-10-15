<?php

namespace MosseboShopCore\Models;

use ScoutElastic\Searchable;
use MosseboShopCore\Models\Base\BaseModel;
use MosseboShopCore\Elasticsearch\Configurators\CityIndexConfigurator;
use MosseboShopCore\Support\Traits\Models\HasEnabledStatus;


abstract class City extends BaseModel
{
    use Searchable, HasEnabledStatus;

    protected $tableKey = 'Cities';

    protected $fillable = [
        'lat',
        'lon',
        'region_id',
        'name',
        'short_name',
        'fias_code',
        'okato_code',
        'aoguid',
        'enabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $indexConfigurator = CityIndexConfigurator::class;

    protected $mapping = [
        'properties' => [
            'id' => [
                'type' => 'integer',
            ],
            'name' => [
                'type' => 'text',
            ],
            'short_name' => [
                'type' => 'text',
            ],
            'region' => [
                'type' => 'text',
            ],
        ]
    ];

    public function toSearchableArray()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
        ];

        if ($this->region) {
            $regionName = [];

            $regionName[] = $this->region->name . ' ' . $this->region->short_name;

            foreach ($this->region->ancestors as $ancestor) {
                $regionName[] = $ancestor->name . ' ' . $ancestor->short_name;
            }

            $data['region'] = implode(', ', $regionName);
        }

        return $data;
    }
}
