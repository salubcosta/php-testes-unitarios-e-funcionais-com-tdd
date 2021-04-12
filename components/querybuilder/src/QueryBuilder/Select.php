<?php

namespace Code\QueryBuilder;

class Select 
{
    private $query;
    private $where;
    private $orderBy;

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

    public function getSql()
    {
        return $this->query . $this->where . $this->orderBy;
    }
}