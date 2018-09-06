<?php

namespace MosseboShopCore\Support\Traits\Models;

trait HasI18n
{
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

    protected function getI18nModelInstance()
    {
        return app()->make($this->getI18nModelName());
    }

    public static function query()
    {
        $query = parent::query();

        return $query->localized();
    }

    public function scopeLocalized($query)
    {
        $i18nModel = $this->getI18nModelInstance();
        $i18nTableName = $i18nModel->getTable();
        $modelTableName = $this->getTable();

        $i18nFields = array_reduce($i18nModel->getFillable(), function($carry, $item) use($i18nTableName) {
            if ($item !== 'language_code' && $item !== $this->relationFieldName) {
                $carry[] = "{$i18nTableName}.{$item}";
            }

            return $carry;
        }, []);

        $i18nFields = implode(', ', $i18nFields);

        return $query
            ->select(\DB::raw("{$modelTableName}.*, {$i18nFields}"))
            ->join($i18nTableName, "{$i18nTableName}.{$this->relationFieldName}", '=', "{$modelTableName}.{$this->getKeyName()}")
            ->where("{$i18nTableName}.language_code", '=', $this->getCurrentLocale());
    }

    protected function getCurrentLocale()
    {
        return app()->getLocale();
    }
}