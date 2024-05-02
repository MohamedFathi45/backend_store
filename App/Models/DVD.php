<?php

namespace App\Models;

class DVD extends Product
{

    static $table = 'DVD';
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

    public function setProductAttributes($row)
    {
        $this->concreteAttributes = $this->concreteAttributeReader->setProductAttributes($this, $row);
    }

    public static function getClassName()
    {
        return self::$table;
    }
    public function setDisplayString()
    {
        $this->displayString = 'Size :' . $this->concreteAttributes[0]['value'] . ' MB';
    }

}
