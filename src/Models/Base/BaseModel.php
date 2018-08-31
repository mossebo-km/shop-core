<?php

namespace MosseboShopCore\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Config;

abstract class BaseModel extends Model
{
    /**
     * Ключ таблицы в конфиге.
     *
     * @var string
     */
    protected $tableIdentif;

    /**
     * Поле, через которое осуществляются связи с другими таблицами.
     *
     * @var string
     */
    protected $relationFieldName;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->table = Config::get("tables.{$this->tableIdentif}");
    }

    /**
     * Проверяет, был ли изменен аттрибут.
     *
     * @param $name
     * @return bool
     */
    protected function attributeIsDirty($name)
    {
        $dirty = $this->getDirty();

        return isset($dirty[$name]);
    }

    /**
     * Отсев данных, которые подходят для использования в этой модели.
     *
     * @param  Array
     * @return Array
     */
    protected function getFillableData(array $data): array
    {
        $fillable = $this->getFillable();

        return array_filter($data, function($key) use($fillable){
            return in_array($key, $fillable);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function relationIsEmpty($relationName)
    {
        return !$this->relationLoaded($relationName) || empty($this[$relationName]);
    }


    public function relationNotEmpty($relationName)
    {
        return !$this->relationIsEmpty($relationName);
    }
}
