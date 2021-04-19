<?php

namespace Code\QueryBuilder\Query;

class Update
{
    private $sql;

    public function __construct(string $table, array $fields = array(), array $conditions = array(), string $operator = "AND")
    {
        $this->sql = "UPDATE `{$table}` SET ";

        $set = array();
        foreach($fields as $f) {
            $set[] = "{$f} = :{$f}";
        }

        $where = "";
        foreach($conditions as $key => $c) {
            $where .= $where ? "{$operator} {$key} = {$c}" : " WHERE {$key} = {$c}";
        }
        $this->sql .= implode(', ', $set).$where;
    }

    public function getSql()
    {
        return $this->sql;
    }
}