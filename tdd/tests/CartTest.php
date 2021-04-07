<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private $cart;
    private $product;

    // É excutado antes de cada teste
    public function setUp(): void 
    {
        $this->cart = new Cart();
        $this->product = new Product();
    }

    // É excutado depois de cada teste
    public function tearDown(): void
    {
        unset($this->cart, $this->product);
    }

    public function testClasseCarrinhoExiste()
    {
        $class = class_exists('\\Code\\Cart');

        $this->assertTrue($class);
    }

    public function testAdicaoDeProdutosNoCarrinho()
    {
        $product_01 = ($this->product)
            ->setName('Product 01')
            ->setPrice(200)
            ->setSlug('product-01');

        $product_02 = ($this->product)
            ->setName('Product 01')
            ->setPrice(200)
            ->setSlug('product-01');
        
        $cart = ($this->cart)->addProduct($product_01)->addProduct($product_02);

        $this->assertIsArray($cart->getProducts());

        $this->assertInstanceOf('\\Code\\Product', $cart->getProducts()[0]);
    }

    public function testSeValoresDeProdutoNoCarrinhoEstaoCorretosConformePassados()
    {
        $product = ($this->product)
            ->setName('Product 01')
            ->setPrice(200)
            ->setSlug('product-01');

        $cart = ($this->cart)->addProduct($product);

        $this->assertEquals('Product 01', $cart->getProducts()[0]->getName());
        $this->assertEquals(200, $cart->getProducts()[0]->getPrice());
        $this->assertEquals('product-01', $cart->getProducts()[0]->getSlug());
    }

    public function testSeTotalDeProdutosEValorDaCompraEstaoCorretos()
    {
        $product_01 = ($this->product)
            ->setName('Product 01')
            ->setPrice(200)
            ->setSlug('product-01');

        $product_02 = ($this->product)
            ->setName('Product 01')
            ->setPrice(200)
            ->setSlug('product-01');
        
        $cart = ($this->cart)->addProduct($product_01)->addProduct($product_02);

        $this->assertEquals(2, $cart->getTotalProducts());
        $this->assertEquals(400, $cart->getTotalPurchases());
    }
}