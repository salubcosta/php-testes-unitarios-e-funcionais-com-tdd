<?php

namespace Code\QueryBuilder\Query;

class Select 
{
    private $query;
    private $where;
    private $orderBy;
    private $limit;
    private $join;

    public function __construct($table)
    {
        $this->query = "SELECT * FROM `{$table}`";
    }

    public function where($field, $operator, $value = null, $concat = 'AND')
    {
        $value = is_null($value) ? ':'.$field : $value;

        if(!$this->where) {
            $this->where .= " WHERE {$field} {$operator} {$value}";
        } else {
            $this->where .= " {$concat} {$field} {$operator} {$value}";
        }

        return $this;
    }

    public function orderBy($field, $order)
    {
        $this->orderBy = " ORDER BY {$field} {$order}";
        return $this;
    }

    public function limit($skip, $take)
    {
        $this->limit = " LIMIT {$skip}, {$take}";

        return $this;
    }

    public function join($joinType, $table, $foreignKey, $operator, $referenceColumn, $concat = false)
    {
        if(!$concat) {
            $this->join .= " {$joinType} {$table} ON {$foreignKey} {$operator} {$referenceColumn}";
        } else {
            $this->join .= " {$concat} {$foreignKey} {$operator} {$referenceColumn}";
        }

        return $this;
    }

    public function select(...$fields)
    {
        $fields = implode(', ', $fields);

        $this->query = str_replace('*', $fields, $this->query);

        return $this;
    }

    public function getSql()
    {
        return $this->query . $this->join . $this->where . $this->orderBy . $this->limit;
    }
}