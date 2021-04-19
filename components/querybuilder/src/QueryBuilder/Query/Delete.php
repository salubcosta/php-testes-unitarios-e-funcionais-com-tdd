<?php

namespace Code\QueryBuilder\Query;

use PhpParser\Node\Stmt\Foreach_;

class Delete
{
    private $sql;

    public function __construct(string $table, array $condtitions, string $logicOperator = 'AND')
    {
        $this->sql = "DELETE FROM `{$table}` WHERE ";

        $where = "";
        foreach($condtitions as $key => $value) {
            $where .= $where ? " {$logicOperator} {$key} = {$value}" : "{$key} = {$value}";
        }

        $this->sql .= $where;
    }

    public function getSql()
    {
        return $this->sql;
    }
}