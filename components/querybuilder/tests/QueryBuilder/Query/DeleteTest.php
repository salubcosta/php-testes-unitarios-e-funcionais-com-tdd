<?php

namespace CodeTests\QueryBuilder\Query;

use PHPUnit\Framework\TestCase;
use Code\QueryBuilder\Delete;

class DeleteTest extends TestCase
{
    private $delete;

    protected function assertPreConditions(): void
    {
        $this->assertTrue(class_exists(Delete::class));
    }

    protected function setUp(): void
    {
        $this->delete = new Delete('products', ['id' => 10, 'qtd' => -1]);
    }

    public function testIfDeleteQueryHasGeneratedWithSuccess()
    {
        $sql = "DELETE FROM `products` WHERE id = 10 AND qtd = -1";
        
        $this->assertEquals($sql, $this->delete->getSql());
    }
}