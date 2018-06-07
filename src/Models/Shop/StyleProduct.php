<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class StyleProduct extends BaseModel
{
    protected $tableIdentif = 'StyleProducts';

    public function styles()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
