<?php

namespace App\Models;

use JsonSerializable;
use PDO;

abstract class Product implements JsonSerializable
{

    protected static $products = array();
    public $db;
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $displayString;
    protected $concreteAttributeReader;
    protected $concreteAttributes = array();
    public $attribute_reader;

    public static function getProducts($db, $factory)
    {
        $stmt = $db->read_products();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product = $factory->getProduct(ProductType::getInstance($db)->types[$row['product_type_id']], $row);
            array_push(self::$products, $product);
        }
        $arr['data'] = self::$products;
        return $arr;
    }

    public static function getGeneralTypes($db)
    {
        $products = array();
        foreach (ProductType::getInstance($db)->types as $productKey => $productValue) {
            $calssName = 'App\\Models\\' . ($productValue);
            $product = new $calssName($db);

            $products[$productValue] = array();
            foreach ($product->attribute_reader->getTypeAttributes() as $attributeKey => $attributeValue) {
                array_push($products[$productValue], $attributeValue);
            }
        }
        return $products;
    }

    public static function addProduct($row, $db, $factory)
    { // product is array of product attributes
        $product = $factory->setProduct($row['type'], $row);
        $db->addProduct($product);
    }

    public static function deleteProducts($db, $productsId)
    {
        $stmt = $db->deleteProducts($productsId);
    }

    public function getConcreteAttributes()
    {return $this->concreteAttributes;}
    public function getId()
    {return $this->id;}
    public function getName()
    {return $this->name;}
    public function getSku()
    {return $this->sku;}
    public function getPrice()
    {return $this->price;}
    public function getType()
    {return $this->type;}

    public function setId($id)
    {$this->id = $id;}
    public function setSku($sku)
    {$this->sku = $sku;}
    public function setName($name)
    {$this->name = $name;}
    public function setPrice($price)
    {$this->price = $price;}
    public function setType($type)
    {$this->type = $type;}

    abstract public static function getClassName();
    abstract public function readConreteAttribues();
    abstract public function setProductAttributes($row);
    abstract public function setDisplayString(); // every product should have attributes to display (ie size , weight ,...etc)
}
