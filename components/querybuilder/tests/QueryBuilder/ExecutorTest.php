<?php

namespace CodeTests\QueryBuilder;

use PHPUnit\Framework\TestCase;
use Code\QueryBuilder\Executor;
use Code\QueryBuilder\Query\Insert;

class ExecutorTest extends TestCase
{
    private static $conn;
    private static $executor;

    public static function setUpBeforeClass(): void 
    {
        self::$conn = new \PDO('sqlite::memory:');
        self::$conn->exec("
            CREATE TABLE IF NOT EXISTS 'products' (
                'id' INTEGER PRIMARY KEY,
                'name' TEXT,
                'price' FLOAT,
                'created_at' TIMESTAMP,
                'updated_at' TIMESTAMP
            );
        ");

        self::$executor = new Executor(self::$conn);
    }

    public static function tearDownAfterClass(): void
    {
        self::$conn->exec("DROP TABLE IF EXISTS 'products'");
    }

    public function testInsertANewProductInADatabase()
    {
        $query = new Insert('products', ['name', 'price', 'created_at', 'updated_at']);

        self::$executor->setQuery($query->getSql());
        self::$executor->setParam(':name', 'Product 1')
                       ->setParam(':price', 19.99)
                       ->setParam(':created_at', date('Y-m-d H:i:s'))
                       ->setParam(':updated_at', date('Y-m-d H:i:s'))
        ;
        self::$executor->execute();
    }
}