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
        $query = $this->select->where('name', '=', ':name', 'concat');
        
        $this->assertEquals("SELECT * FROM `products` WHERE name = :name", $query->getSql());
    }

    public function testIfQueryAllowUsAddMoreConditionsInOurQueryWithWhere()
    {
        $query = $this->select->where('name', '=', ':name')
                              ->where('price', '>=', ':price');

        $this->assertEquals("SELECT * FROM `products` WHERE name = :name AND price >= :price", $query->getSql());
    }

    public function testIfQueryIsGeneratedWithOrderBy()
    {
        $query = $this->select->orderBy('name', 'DESC');
        
        $this->assertEquals("SELECT * FROM `products` ORDER BY name DESC", $query->getSql());
    }

    public function testIfQueryIsGeneratedWithLimit()
    {
        $query = $this->select->limit(0, 15);

        $this->assertEquals("SELECT * FROM `products` LIMIT 0, 15", $query->getSql());
    }

    public function testIfQueryIsGeneratedWithJoinsConditions()
    {
        $query = $this->select->join('INNER JOIN', 'colors', 'products.id', '=', 'colors.product_id');
        
        $this->assertEquals("SELECT * FROM `products` INNER JOIN colors ON products.id = colors.product_id", $query->getSql());
    }

    public function testIfQueryWithSelectedFieldsIsGeneratedWithSuccess()
    {
        $query = $this->select->select('name', 'price');

        $this->assertEquals("SELECT name, price FROM `products`", $query->getSql());
    }
}