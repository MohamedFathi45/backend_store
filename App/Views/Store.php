<?php

namespace App\Views;

use App\Controllers\Controller;
use App\Controllers\ProductController;
use App\Models\Router;

class Store
{
    private static $instance = null;
    public Router $router;
    protected Controller $controller;
    private function __construct()
    {
        $this->router = new Router();
        $this->controller = new ProductController();
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Store();
        }
        return self::$instance;
    }

    public function getProducts()
    {
        $products = $this->controller->getProducts();
        $obj = json_encode($products);
        echo $obj;
    }
    public function getGeneralTypes()
    {
        $products = $this->controller->getGeneralTypes();
        $ret['data'] = $products;
        echo json_encode($ret);
    }
    public function deleteProducts($input)
    {
        $this->controller->deleteProducts($input);
    }

    public function addProduct($input)
    { // product at this time is array
        $this->controller->addProduct($input);
    }
}
