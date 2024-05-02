<?php
namespace App\Models;

abstract class ConcreteAttribute
{

    abstract public function read_concrete_attributes($product);
    abstract public function setProductAttributes($product, $row);
}
