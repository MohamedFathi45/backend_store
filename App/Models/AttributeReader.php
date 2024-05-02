<?php
namespace App\Models;

use PDO;

class AttributeReader extends Attribute
{

    public function __construct($id, $db)
    {
        $this->type_id = $id;
        $this->db = $db;
        $this->read_type_attributes();
    }

    public function read_type_attributes()
    {
        $stmt = $this->db->read_type_attributes($this->type_id);
        $this->destructure_attributes($stmt);
    }

    public function destructure_attributes($arr)
    {
        while ($row = $arr->fetch(PDO::FETCH_NUM)) {
            $this->attributes[$row[0]] = $row[1];
        }
    }
}
