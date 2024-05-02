<?php

namespace App\Controllers;

use App\Config\MysqlDatabase;
use App\Models\Product;
use App\Models\ProductFactory;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->databaseController = new MysqlDatabase();
        $this->factory = new ProductFactory($this->databaseController);
    }

    public function deleteProducts($input)
    {
        $obj = json_decode($input);
        Product::deleteProducts($this->databaseController, $obj->data);
    }
    public function addProduct($input)
    {
        $obj = json_decode($input); //obj is array of feilds
        $row = json_decode(json_encode($obj), true);
        Product::addProduct($row, $this->databaseController, $this->factory);
    }
    public function getGeneralTypes()
    {
        return Product::getGeneralTypes($this->databaseController);
    }
    public function getProducts()
    {
        return Product::getProducts($this->databaseController, $this->factory);
    }
}
