<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class ProductAttributeOption extends BaseModel
{
    protected $tableIdentif = 'ProductAttributeOptions';

    public function attributes()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function options()
    {
        return $this->belongsTo(AttributeOption::class, 'option_id');
    }
}
