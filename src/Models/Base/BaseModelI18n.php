<?php

namespace MosseboShopCore\Models\Base;

use App;
use Config;

abstract class BaseModelI18n extends BaseModel
{
    protected $translateTableName;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->translateTableName = Config::get("tables.{$this->tableIdentif}I18n");
    }

    public function i18n()
    {
        return $this->hasMany($this->getI18nModelName(), $this->relationFieldName);
    }

    public function currentI18n()
    {
        return$this->hasOne($this->getI18nModelName(), $this->relationFieldName)
            ->where('language_code', '=', App::getLocale());
    }

    public function getI18nModelName()
    {
        return get_class($this) . 'I18n';
    }

    public static function withTranslate($languageCode = null)
    {
        return self::addTranslateToQuery($languageCode ?: App::getLocale());
    }

    protected static function addTranslateToQuery($languageCode, $query = false)
    {
        $instance = new static;

        if (! $query) {
            $query = $instance->newQuery();
        }

        return $query
            ->join($instance->translateTableName, "{$instance->translateTableName}.{$instance->relationFieldName}", '=', "{$instance->table}.id")
            ->where("{$instance->translateTableName}.language_code", '=', $languageCode);
    }
}