<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Views\Store;

require_once "vendor/autoload.php";

$app = Store::getInstance();
$app->router->get('/backend_store/index.php', function () use ($app){
    $app->getProducts();
});

$app->router->get('/backend_store/index.php/products', function ()use ($app) {
    $app->getGeneralTypes();
});
$app->router->post('/backend_store/index.php/addproduct', function ()use ($app) {
    $input = file_get_contents("php://input");
    $app->addProduct($input);
});
$app->router->post('/backend_store/index.php/deleteproduct', function ()use ($app) {
    $input = file_get_contents("php://input");
    $app->deleteProducts($input);
});

$app->router->run();
