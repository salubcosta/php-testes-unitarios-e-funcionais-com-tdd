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

    // public function testClasseCarrinhoExiste()
    // {
    //     $class = class_exists('\\Code\\Cart');

    //     $this->assertTrue($class);
    // }

    // Todos os testes da classe só serão executados atender esta condição: class_exists
    protected function assertPreConditions(): void
    {
        $class = class_exists('\\Code\\Cart');

        $this->assertTrue($class);
    }

    protected function assertPostConditions(): void
    {
        // Executa sempre depois do teste e o método tearDown
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
        // $product = ($this->product)
        //     ->setName('Product 01')
        //     ->setPrice(200)
        //     ->setSlug('product-01');

        $productStub = $this->getStubProduct();

        $cart = ($this->cart)->addProduct($productStub);

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

    public function testIncompleto()
    {
        $this->assertTrue(true);
        $this->markTestIncomplete('Teste não está completo');
    }

    /**
     * @requires PHP == 5.3
     */
    public function testSeFeatureEspecificaParaVersao53PHPTrabalhaDeFormaEsperada()
    {
        // if(PHP_VERSION > 7) {
        //     $this->markTestSkipped('Só exeuta nas versoes abaixo do PHP 7');
        // }

        return $this->assertTrue(true);
    }

    public function testSeLogESalvoQuandoInformadoParaAAdicaoDeProduto()
    {
        $cart = new Cart();

        $logMock = $this->getMockBuilder(Log::class)
                        ->onlyMethods(['log'])
                        ->getMock();
        $logMock->expects($this->once())->method('log')->with($this->equalTo('Adicionando produto no carrinho'));

        $cart->addProduct($this->getStubProduct(), $logMock);
    }

    private function getStubProduct()
    {
        $productStub = $this->createMock(\Code\Product::class);
        $productStub->method('getName')->willReturn('Product 01');
        $productStub->method('getPrice')->willReturn(200);
        $productStub->method('getSlug')->willReturn('product-01');

        return $productStub;
    }
}