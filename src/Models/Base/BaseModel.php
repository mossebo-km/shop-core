<?php

namespace MosseboShopCore\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Config;

abstract class BaseModel extends Model
{
    protected $tableIdentif;

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
    protected function getFillableData(Array $data): Array
    {
        $fillable = $this->getFillable();

        return array_filter($data, function($key) use($fillable){
            return in_array($key, $fillable);
        }, ARRAY_FILTER_USE_KEY);


//        return array_map(function($paramName) use ($data) {
//            return isset($data[$paramName]) ? $data[$paramName] : Null;
//        }, $fillable);
    }
}