<?php

namespace MosseboShopCore\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Config;

abstract class BaseModel extends Model
{
    protected $queryBuilder = null;
    protected $useTableNameInQuery = true;
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

        $this->table = Config::get("tables.{$this->tableKey}");
    }

    public function getForeignKey()
    {
        return $this->relationFieldName ?: parent::getForeignKey();
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

    /**
     * @param $relationName
     * @return bool
     */
    public function relationNotEmpty($relationName)
    {
        return !$this->relationIsEmpty($relationName);
    }

    public function newQuery()
    {
        if (is_null($this->queryBuilder) && $this->useTableNameInQuery) {
            $this->queryBuilder = parent::newQuery();

            if ($this->getKeyName()) {
                $tableName = $this->getTable();
                $tableKey = $tableName . '.' . $this->getKeyName();

                $this->queryBuilder
                    ->selectRaw("DISTINCT on ({$tableKey}) {$tableName}.*")
                    ->groupBy(\DB::raw("{$tableKey}"))
                    ->orderBy(\DB::raw("{$tableKey}"));
            }
        }

        return $this->queryBuilder;
    }

    public function hasManyThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null)
    {
        $through = new $through;

        $firstKey = $firstKey ?: $this->getForeignKey();
        $secondKey = $secondKey ?: $through->getForeignKey();
        $localKey = $localKey ?: $this->getKeyName();
        $secondLocalKey = $secondLocalKey ?: $through->getKeyName();

        return $this->newHasManyThrough(
            $this->newRelatedInstance($related)->newQuery(), $this, $through,
            $firstKey, $secondKey, $localKey, $secondLocalKey
        )->groupBy("{$through->getTable()}.{$firstKey}");
    }

    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->$method(...$parameters);
        }

        if ($parameters && is_string($parameters[0])) {
            if (in_array($parameters[0], $this->getFillable())) {
                $parameters[0] = "{$this->getTable()}.{$parameters[0]}";
            }
        }

        $result = $this->newQuery()->$method(...$parameters);

        if ($result instanceof QueryBuilder) {
            return $this;
        }

        return $result;
    }
}



