<?php

namespace MosseboShopCore\Models\Shop;

use MosseboShopCore\Models\Base\BaseModel;

class Price extends BaseModel
{
    protected $tableIdentif = 'Prices';

    public function type()
    {
        return $this->hasOne(PriceType::class, 'price_type_id');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'item');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    public function getCurrency()
    {
        return \Currencies::where('code', $this->currency_code)->first();
    }

    public function getFormatted()
    {
        extract($this->getCurrency()->toArray(), EXTR_OVERWRITE);

        $price = number_format(
            $this->getValue(),
            $precision,
            $decimal_separator,
            $thousand_separator
        );

        $price = str_replace(('.' . str_pad('', $precision, '0')), '', $price);

        if ($swap_currency_symbol) {
            $price = "$price $symbol";
        }
        else {
            $price = "$symbol $price";
        }

        return $price;
    }

    public function getValue()
    {
        return $this->value / $this->getDivider();
    }

    /**
     * @return integer
     */
    public function getDivider()
    {
        return pow(10, $this->getCurrency()['precision']);
    }
}