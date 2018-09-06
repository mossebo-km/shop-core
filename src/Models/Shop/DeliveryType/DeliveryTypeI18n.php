<?php

namespace MosseboShopCore\Models\Shop\DeliveryType;

use MosseboShopCore\Models\Base\BaseModel;

abstract class DeliveryTypeI18n extends BaseModel
{
    protected $tableKey = 'DeliveryTypesI18n';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'category_id',
        'language_code',
        'title',
        'description',
        'meta_title',
        'meta_description'
    ];

    public $timestamps = false;
}