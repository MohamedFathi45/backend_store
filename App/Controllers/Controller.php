<?php

namespace App\Controllers;

abstract class Controller
{
    protected $databaseController;
    protected $factory;
    abstract public function addProduct($product);
    abstract public function deleteProducts($productsId);
    abstract public function getGeneralTypes();
    abstract public function getProducts();
}
