<?php

namespace MosseboShopCore\Repositories;

use Illuminate\Support\Collection;
use MosseboShopCore\Contracts\Repositories\AttributeRepository as AttributeRepositoryContract;

class AttributeRepository extends BaseRepository implements AttributeRepositoryContract
{
    protected $modificators = [
        'i18n',
        'currentI18n'
    ];


}
