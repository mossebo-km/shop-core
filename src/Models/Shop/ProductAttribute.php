<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class ProductAttribute extends BaseModel
{
    protected $tableIdentif = 'ProductAttributes';

    public function attributes()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}