<?php

namespace App\Models;

class ProductFactory extends Factory
{

    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createProduct($type)
    { //returns product
        $calssName = 'App\\Models\\' . ($type);
        return new $calssName($this->db);
    }

}
