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
        $this->select = new Select('products');
    }

    public function testIfQueryBaseIsGeneratedWithSuccess()
    {
        $query = $this->select->getSql('products');

        $this->assertEquals("SELECT * FROM `products`", $query);
    }

    public function testIfQueryIsGeneratedWithWhereConditions()
    {
        $query = $this->select->where('name', '=', 'Product 01', 'concat');
        $this->assertEquals("SELECT * FROM `products` WHERE name = 'Product 01'", $query->getSql());
    }
}