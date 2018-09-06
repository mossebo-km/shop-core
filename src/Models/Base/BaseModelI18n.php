<?php

namespace MosseboShopCore\Models\Base;

use App;
use Config;

abstract class BaseModelI18n extends BaseModel
{
    protected $translateTableName;

    public function i18n()
    {
        return $this->hasMany($this->getI18nModelName(), $this->relationFieldName);
    }

    public function currentI18n()
    {
        return $this->hasOne($this->getI18nModelName(), $this->relationFieldName)
            ->where('language_code', '=', $this->getCurrentLocale());
    }

    public function getI18nModelName()
    {
        return get_class($this) . 'I18n';
    }

    public function getI18nTable()
    {
        return (new $this->getI18nModelName())->getTable();
    }

    public static function query()
    {
        $query = parent::query();

        return $query->localized();
    }

    public function scopeLocalized($query)
    {
        $i18nTableName = $this->getI18nTable();

        return $query
            ->join($i18nTableName, "{$i18nTableName}.{$this->relationFieldName}", '=', "{$this->getTable()}.{$this->getKeyName()}")
            ->where("{$i18nTableName}.language_code", '=', $this->getCurrentLocale());
    }

    protected function getCurrentLocale()
    {
        return app()->getLocale();
    }
}