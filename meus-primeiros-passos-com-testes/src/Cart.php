<?php 

namespace Code;

class Cart
{
    private $products = [];

    public function addProduct($product, $log = null)
    {
        $this->products[] = $product;

        if($log) $log->log('Adicionando produto no carrinho');

        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getTotalProducts()
    {
        return count($this->products);
    }

    public function getTotalPurchases()
    {
        $totalPurchase = 0;

        foreach($this->products as $p){
            $totalPurchase += $p->getPrice();
        }
        
        return $totalPurchase;
    }
}