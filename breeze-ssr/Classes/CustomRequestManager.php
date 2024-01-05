<?php

namespace API\SSR\Classes;

use API\SSR\Utils\Functions;

use ClanCats\Hydrahon\Query\Sql\{FetchableInterface, Insert, Func};
use ClanCats\Hydrahon\Query\Expression as Exp;
use ClanCats\Hydrahon\Builder;

class CustomRequestManager extends DbManager
{
    private $errorMessage;
    private $buildedQuery;
    private $jsonQuery;
    private $builder;
    private $runner;

    public function __construct()
    {
        parent::__construct();

        $db = $this->database;

        $this->builder = new Builder('mysql', function ($query, $queryString, $queryParameters) use ($db) {

            $statement = $db->prepare($queryString);
            $result = $statement->execute($queryParameters);

            if (isset($this->runner) && $this->runner != 'get' && $this->runner != 'execute') {

                switch ($this->runner) {

                    case 'count':
                        return [[$this->jsonQuery['runner'] => $statement->fetchColumn()]];

                }

            }

            if ($query instanceof FetchableInterface) return $statement->fetchAll(\PDO::FETCH_ASSOC);

            elseif ($query instanceof Insert) return $db->lastInsertId();

            else return $statement->rowCount();
        });
    }

    public function handleJsonQuery($jsonQuery)
    {
        $this->jsonQuery = $jsonQuery;

        if (!isset($jsonQuery['action'])) {

            $this->errorMessage = 'Undefined action';

            return $this;
        }

        try {
            switch ($jsonQuery['action']) {

                case 'select':
                    $this->buildSqlSelectQuery();
                    break;

                case 'insert':
                    $this->buildSqlInsertQuery();
                    break;

                case 'update':
                    $this->buildSqlUpdateQuery();
                    break;

                case 'delete':
                    $this->buildSqlDeleteQuery();
                    break;
            }
        } catch (\Exception $e) {

            $this->errorMessage = $e->getMessage();

            return $this;
        }

        if (!isset($this->buildedQuery)) {

            $this->errorMessage = 'Unknown action';

            return $this;
        }

        $this->errorMessage = NULL;

        return $this;
    }

    private function buildSqlSelectQuery()
    {
        if (!isset($this->jsonQuery['table'])) throw new \Exception('Undefined table');

        $query = $this->builder->table($this->resolveTableName($this->jsonQuery['table']));

        if (isset($this->jsonQuery['columns']) && is_array($this->jsonQuery['columns'])) $this->buildedQuery = $query->select($this->jsonQuery['columns']);
        else $this->buildedQuery = $query->select();

        if (isset($this->jsonQuery['functions']) && is_array($this->jsonQuery['functions'])) {
            foreach ($this->jsonQuery['functions'] as $key => $function) {

                $this->resolveFunction($function);
            }
        }

        if (isset($this->jsonQuery['expressions']) && is_array($this->jsonQuery['expressions'])) {
            foreach ($this->jsonQuery['expressions'] as $key => $expression) {

                $this->resolveExpression($expression);
            }
        }

        if (isset($this->jsonQuery['conditions']) && is_array($this->jsonQuery['conditions'])) {
            foreach ($this->jsonQuery['conditions'] as $key => $condition) {

                $this->resolveCondition($condition);
            }
        }
    }

    private function buildSqlInsertQuery()
    {
        if (!isset($this->jsonQuery['table'])) throw new \Exception('Undefined table');

        if (!isset($this->jsonQuery['data']) || !is_array($this->jsonQuery['data'])) throw new \Exception('Missing data');

        $query = $this->builder->table($this->resolveTableName($this->jsonQuery['table']));

        $this->buildedQuery = $query->insert($this->jsonQuery['data']);
    }

    private function buildSqlUpdateQuery()
    {
        if (!isset($this->jsonQuery['table'])) throw new \Exception('Undefined table');

        if (!isset($this->jsonQuery['data']) || !is_array($this->jsonQuery['data'])) throw new \Exception('Missing data');

        if (!isset($this->jsonQuery['conditions']) || !is_array($this->jsonQuery['conditions'])) throw new \Exception('Missing conditions');

        $query = $this->builder->table($this->resolveTableName($this->jsonQuery['table']));

        $this->buildedQuery = $query->update($this->jsonQuery['data']);

        foreach ($this->jsonQuery['conditions'] as $key => $condition) {

            $this->resolveCondition($condition);
        }
    }

    private function buildSqlDeleteQuery()
    {
        if (!isset($this->jsonQuery['table'])) throw new \Exception('Undefined table');

        if (!isset($this->jsonQuery['conditions']) || !is_array($this->jsonQuery['conditions'])) throw new \Exception('Missing conditions');

        $query = $this->builder->table($this->resolveTableName($this->jsonQuery['table']));

        $this->buildedQuery = $query->delete();

        foreach ($this->jsonQuery['conditions'] as $key => $condition) {

            $this->resolveCondition($condition);
        }
    }

    private function resolveCondition($condition)
    {
        if (is_array($condition) && !empty($condition)) {

            if (Functions::isAssoc($condition)) {

                $key = array_key_first($condition);
                $value = $condition[$key];
            } else {

                $key = $condition[0];
                $value = NULL;
            }

            if (is_string($key)) {
                switch (trim($key)) {

                    case 'where':
                    case 'orWhere':
                    case 'andWhere':
                        if (is_array($value)) {

                            $hasSubConditions = false;

                            for ($i = 0; $i < count($value); $i++) {
                                if (is_array($value[$i])) $hasSubConditions = true;
                            }

                            if ($hasSubConditions) {

                                $this->buildedQuery = $this->buildedQuery->{trim($key)}(function ($q) use ($value) {

                                    for ($i = 0; $i < count($value); $i++) {

                                        if (is_array($value[$i]) && Functions::isAssoc($value[$i])) {

                                            $subKey = array_key_first($value[$i]);
                                            $subValue = $value[$i][$subKey];

                                            if (is_string($subKey)) {
                                                switch (trim($subKey)) {

                                                    case 'where':
                                                    case 'orWhere':
                                                    case 'andWhere':
                                                        if (count($subValue) == 2) $q->{trim($subKey)}($subValue[0], $subValue[1]);
                                                        if (count($subValue) == 3) $q->{trim($subKey)}($subValue[0], $subValue[1], $subValue[2]);
                                                        break;

                                                    case 'whereNull':
                                                    case 'orWhereNull':
                                                    case 'andWhereNull':
                                                    case 'whereNotNull':
                                                    case 'orWhereNotNull':
                                                    case 'andWhereNotNull':
                                                        $q->{trim($subKey)}($subValue);
                                                        break;

                                                    case 'whereIn':
                                                    case 'whereNotIn':
                                                        if (is_array($subValue) && count($subValue) == 2 && is_array($subValue[1])) {
                                                            $q->{trim($subKey)}(
                                                                $subValue[0],
                                                                $subValue[1]
                                                            );
                                                        }
                                                        break;
                                                }
                                            }
                                        }
                                    }
                                });
                            } else {

                                if (count($value) == 2) $this->buildedQuery = $this->buildedQuery->{trim($key)}($value[0], $value[1]);
                                if (count($value) == 3) $this->buildedQuery = $this->buildedQuery->{trim($key)}($value[0], $value[1], $value[2]);
                            }
                        }
                        break;

                    case 'groupBy':
                    case 'orderBy':
                    case 'whereNull':
                    case 'orWhereNull':
                    case 'andWhereNull':
                    case 'whereNotNull':
                    case 'orWhereNotNull':
                    case 'andWhereNotNull':
                        $this->buildedQuery = $this->buildedQuery->{trim($key)}($value);
                        break;

                    case 'whereIn':
                    case 'whereNotIn':
                        if (is_array($value) && count($value) == 2 && is_array($value[1])) {
                            $this->buildedQuery = $this->buildedQuery->{trim($key)}($value[0], $value[1]);
                        }
                        break;

                    case 'descOrderBy':
                        $this->buildedQuery = $this->buildedQuery->orderBy($value, 'desc');
                        break;

                    case 'page':
                    case 'limit':
                        if (is_array($value)) {
                            if (count($value) == 1) $this->buildedQuery = $this->buildedQuery->{trim($key)}($value[0]);
                            if (count($value) == 2) $this->buildedQuery = $this->buildedQuery->{trim($key)}($value[0], $value[1]);
                        } else {
                            $this->buildedQuery = $this->buildedQuery->{trim($key)}($value);
                        }
                        break;

                    case 'distinct':
                    case 'resetWheres':
                        $this->buildedQuery = $this->buildedQuery->{trim($key)}();
                        break;

                    case 'join':
                    case 'leftJoin':
                    case 'rightJoin':
                    case 'innerJoin':
                    case 'outerJoin':
                        $finalKey = trim($key) === 'join' ? 'leftJoin' : trim($key);
                        if (is_array($value) && count($value) == 4) {
                            $this->buildedQuery = $this->buildedQuery->{$finalKey}(
                                $this->resolveTableName($value[0]),
                                $this->resolveTableName($value[1]),
                                $value[2],
                                $this->resolveTableName($value[3])
                            );
                        }
                        break;
                }
            }
        }
    }

    private function resolveFunction($function)
    {
        if (is_array($function) && !empty($function)) {

            if (Functions::isAssoc($function)) {

                $key = array_key_first($function);
                $value = $function[$key];

                if (is_array($value) && !empty($value)) $this->buildedQuery = $this->buildedQuery->addField(new Func($key, $value[0]), count($value) == 2 ? $value[1] : NULL);
                else $this->buildedQuery = $this->buildedQuery->addField(new Func($key, $value));
            } else {

                $this->buildedQuery = $this->buildedQuery->addField(new Func($function[0]));
            }
        }
    }

    private function resolveExpression($expression)
    {
        if (is_string($expression)) {

            $this->buildedQuery = $this->buildedQuery->addField(new Exp($expression));
        } else if (is_array($expression)) {

            $this->buildedQuery = $this->buildedQuery->addField(new Exp($expression[0]), count($expression) == 2 ? $expression[1] : NULL);
        }
    }

    private function resolveTableName($name)
    {
        if (isset($this->jsonQuery['resolve']) && !$this->jsonQuery['resolve']) return $name;

        return Functions::resolveTableName($name);
    }

    public function execute($queryData = NULL)
    {
        if (is_null($queryData)) {
            if (!isset($this->buildedQuery) || is_null($this->buildedQuery)) return $this->errorMessage;

            if (isset($this->jsonQuery['runner'])) {

                $key = $value = NULL;

                if (is_array($this->jsonQuery['runner'])) {

                    if (!empty($this->jsonQuery['runner'])) {

                        if (Functions::isAssoc($this->jsonQuery['runner'])) {

                            $key = array_key_first($this->jsonQuery['runner']);
                            $value = $this->jsonQuery['runner'][$key];
                        } else {

                            $key = $this->jsonQuery['runner'][0];
                            if (count($this->jsonQuery['runner']) == 2) $value = $this->jsonQuery['runner'][1];
                            if (count($this->jsonQuery['runner']) > 2) $value = [$this->jsonQuery['runner'][1], $this->jsonQuery['runner'][2]];
                        }
                    }
                } else {

                    $key = $this->jsonQuery['runner'];
                }

                if (is_null($key)) return $this->buildedQuery->execute();

                $this->runner = trim($key);

                switch ($this->runner) {

                    case 'get':
                    case 'one':
                    case 'exists':
                        return $this->buildedQuery->{$this->runner}();

                    case 'column':
                    case 'count':
                    case 'sum':
                    case 'min':
                    case 'max':
                    case 'avg':
                        return $this->buildedQuery->{$this->runner}($value);

                    case 'first':
                    case 'last':
                        return is_null($value) ? $this->buildedQuery->{$this->runner}() : $this->buildedQuery->{$this->runner}($value);

                    case 'find':
                        if (is_array($value)) {

                            if (count($value) == 1) return $this->buildedQuery->{$this->runner}($value[0]);
                            if (count($value) > 1) return $this->buildedQuery->{$this->runner}($value[1], $value[0]);
                        } else return $this->buildedQuery->{$this->runner}($value);
                }

                return $this->buildedQuery->execute();
            } else {

                switch ($this->jsonQuery['action']) {

                    case 'select':
                        $this->runner = 'get';
                        return $this->buildedQuery->get();
                    case 'insert':
                    case 'update':
                    case 'delete':
                        $this->runner = 'execute';
                        return $this->buildedQuery->execute();
                }
            }
        } else {
            switch ($queryData['action']) {

                case 'select':
                    $snapshot = $this->database->query($queryData['query']);

                    return $snapshot->fetchAll(\PDO::FETCH_ASSOC);

                case 'insert':
                    $req = $this->database->prepare($queryData['query']);

                    $req->execute($queryData['data']);

                    return $this->database->lastInsertId();

                case 'update':
                case 'delete':
                    $req = $this->database->prepare($queryData['query']);

                    return $req->execute($queryData['data']);

                case 'freestyle':
                    if (isset($queryData['data'])) {
                        $req = $this->database->prepare($queryData['query']);

                        $req->execute($queryData['data']);
                    } else {
                        $req = $this->database->query($queryData['query']);
                    }

                    return $req->rowCount();
            }
        }
    }
}
