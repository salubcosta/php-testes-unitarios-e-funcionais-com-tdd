<?php

namespace Code\QueryBuilder;

class Select 
{
    private $query;

    public function __construct($table)
    {
        $this->query = "SELECT * FROM `{$table}`";
    }

    public function where($field, $operator, $value)
    {
        $this->query .= " WHERE {$field} {$operator} '{$value}'";

        return $this;
    }

    public function getSql()
    {
        return $this->query;
    }
}