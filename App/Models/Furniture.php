<?php

namespace App\Models;

class Furniture extends Product
{
    static $table = "Furniture";
    protected static $attributes = array();
    public function __construct($db)
    {
        $this->db = $db;
        $this->type = self::$table;
        $this->attribute_reader = new AttributeReader(array_search(self::$table, ProductType::getInstance($this->db)->types), $this->db);
        $this->concreteAttributeReader = new ConcreteAttributeReader();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    public function readConreteAttribues()
    {
        $this->concreteAttributes = $this->concreteAttributeReader->read_concrete_attributes($this);
    }
    public function setDisplayString()
    {
        $height_value = $this->getProp('height'); // iterating over the list O(n) "n most likely to be less than 50"
        $width_value = $this->getProp('width');
        $length_value = $this->getProp('length');

        $this->displayString = 'Dimensions: ' . $height_value . 'x' . $width_value . 'x' . $length_value . ' CM';
    }
    public static function getClassName()
    {
        return self::$table;
    }
    public function getProp($prop)
    {
        foreach ($this->concreteAttributes as $element) {
            if ($element['name'] == $prop) {
                return $element['value'];
            }
        }
    }
    public function setProductAttributes($row)
    {
        $this->concreteAttributes = $this->concreteAttributeReader->setProductAttributes($this, $row);
    }
}
