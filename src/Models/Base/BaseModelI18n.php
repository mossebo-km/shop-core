<?php

namespace MosseboShopCore\Models\Base;

use Config;

abstract class BaseModelI18n extends BaseModel
{
    protected $translateTableName;
    protected $translateRelationField;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->translateTableName = Config::get("migrations.{$this->tableIdentif}I18n");
    }

    public function i18n()
    {
        return $this->hasMany($this->getI18nModelName(), $this->translateRelationField);
    }

    public function getI18nModelName()
    {
        return get_class($this) . 'I18n';
    }

    public static function withTranslate($languageCode = null)
    {
        return self::addTranslateToQuery($languageCode ?: 'ru');
    }

    protected static function addTranslateToQuery($languageCode, $query = false)
    {
        $instance = new static;

        if (! $query) {
            $query = $instance->newQuery();
        }

        return $query
            ->join($instance->translateTableName, "{$instance->translateTableName}.{$instance->translateRelationField}", '=', "{$instance->table}.id")
            ->where("{$instance->translateTableName}.language_code", '=', $languageCode);
    }
}