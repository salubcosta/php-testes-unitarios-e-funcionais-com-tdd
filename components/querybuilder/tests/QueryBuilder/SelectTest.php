<?php

namespace CodeTests\QueryBuilder;

use PHPUnit\Framework\TestCase;

use Code\QueryBuilder\Select;

class SelectTest extends TestCase
{
    protected $select;

    protected function assertPreConditions(): void
    {
        $this->assertTrue(class_exists(Select::class));
    }

    protected function setUp(): void
    {
        $this->select = new Select();
    }

    public function testIfQueryBaseIsGeneratedWithSuccess()
    {
        $query = $this->select('products');

        $this->assertEquals('SELECT * FROM products', $query->getSql());
    }
}