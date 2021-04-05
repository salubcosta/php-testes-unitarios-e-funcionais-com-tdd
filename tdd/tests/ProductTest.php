<?php

namespace Code;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testNomeSetadoCorretamente()
    {
        $product = (new Product())->setName('Product 01');
        
        $this->assertEquals('Product 01', $product->getName(), "Values aren't equals");
    }

    public function testPriceSetadoCorretamente()
    {
        $product = (new Product())->setPrice(100.9);
        
        $this->assertEquals(100.9, $product->getPrice(), "Values aren't equals");
    }

    public function testSlugSetadoCorretamente()
    {
        $product = (new Product())->setSlug('product-01');
        
        $this->assertEquals('product-01', $product->getSlug(), "Values aren't equals");
    }
}