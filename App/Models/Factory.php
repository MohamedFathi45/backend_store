<?php

namespace App\Models;

abstract class Factory
{

    public function getProduct($type, $row)
    { // for case of getting product from the databas
        $product = $this->createProduct($type);
        extract($row);
        $product->setId($id);
        $product->setType($type);
        $product->setName($name);
        $product->setSku($sku);
        $product->setPrice($price);
        $product->readConreteAttribues();
        $product->setDisplayString();
        return $product;
    }

    public function setProduct($type, $row)
    { //for case of setting the product in the database
        $product = $this->createProduct($type);
        extract($row);
        $product->setType($type);
        $product->setName($name);
        $product->setSku($sku);
        $product->setPrice($price);
        $product->setProductAttributes($row);
        return $product;
    }
    abstract public function createProduct($type);

}
