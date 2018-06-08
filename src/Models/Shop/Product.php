<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModelI18n;

abstract class Product extends BaseModelI18n
{
    protected $tableIdentif = 'Products';
    protected $relationFieldName = 'product_id';
    protected $mediaCollectionName = 'images';

    /**
     * Адрес товара на сайте.
     *
     * @return string
     */
    public function url()
    {
        return "/goods/{$this->id}";
    }
}


