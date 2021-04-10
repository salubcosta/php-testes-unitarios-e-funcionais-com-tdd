<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $product;

    // É excutado antes de cada teste 
    public function setUp(): void
    {
        $this->product = new Product();
    }

    // É excutado depois de cada teste 
    public function tearDown(): void
    {
        unset($this->product);
    }
    
    // É executado apenas uma vez antes de cada teste da classe
    public static function setUpBeforeClass(): void
    {
        print __METHOD__;
    }

    // É executado apenas uma vez depois de cada teste da classe
    public static function tearDownAfterClass(): void
    {
        print __METHOD__;
    }

    public function testNomeSetadoCorretamente()
    {
        $product = ($this->product)->setName('Product 01');
        
        $this->assertEquals('Product 01', $product->getName(), "Values aren't equals");
    }

    public function testPriceSetadoCorretamente()
    {
        $product = ($this->product)->setPrice(100.9);
        
        $this->assertEquals(100.9, $product->getPrice(), "Values aren't equals");
    }

    public function testSlugSetadoCorretamente()
    {
        $product = ($this->product)->setSlug('product-01');
        
        $this->assertEquals('product-01', $product->getSlug(), "Values aren't equals");
    }

    /**
     * @expectedException | invalidArgumentException
     * @expectedExceptionMessage Parâmetro inválido, informe slug
     */
    public function testSeSetSlugLancaExceptionQuandoNaoInformada()
    {
        $this->expectException('\InvalidArgumentException');
        $this->expectExceptionMessage('Parâmetro inválido, informe slug');
        
        $product = $this->product;
        $product->setSlug('');
    }
}