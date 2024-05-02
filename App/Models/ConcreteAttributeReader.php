<?php
namespace App\Models;

use PDO;

class ConcreteAttributeReader extends ConcreteAttribute
{

    public function read_concrete_attributes($product)
    {
        $stmt = $product->db->readConreteAttribues($product->getId());
        $ret = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['name'] = $product->attribute_reader->getTypeAttributes()[$row['attribute_id']];
            array_push($ret, $row);
        }
        return $ret;
    }

    public function setProductAttributes($product, $row)
    {
        $ret = array();
        foreach ($product->attribute_reader->getTypeAttributes() as $attribute) {
            $row[$attribute];
            $attribute_id = array_search($attribute, $product->attribute_reader->getTypeAttributes());
            $attribute_value = $row[$attribute];
            $r = array();
            $r['attribute_id'] = $attribute_id;
            $r['value'] = $attribute_value;
            array_push($ret, $r);
        }
        return $ret;
    }
}
