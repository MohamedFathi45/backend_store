<?php

namespace App\Models;

use PDO;

class ProductType
{

    private static $instance = null;
    public $types = array();
    private function __construct($db)
    {
        $stmt = $db->read_types();
        $this->destructure_types($stmt);
    }
    public function destructure_types($arr)
    {
        while ($row = $arr->fetch(PDO::FETCH_NUM)) {
            $this->types[$row[0]] = $row[1];
        }
    }
    public static function getInstance($db)
    {
        if (self::$instance == null) {
            self::$instance = new ProductType($db);
        }
        return self::$instance;
    }

}
