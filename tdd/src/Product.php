<?php

namespace Code;

class Product
{
    private $name;
    private $price;
    private $slug;
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        if (!$slug) {
            throw new \InvalidArgumentException('Parâmetro inválido, informe slug');
        }
        $this->slug = $slug;

        return $this;
    }
}