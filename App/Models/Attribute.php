<?php
namespace App\Models;

abstract class Attribute
{
    protected $type_id;
    protected $db;
    protected $attributes;
    abstract public function read_type_attributes();

    public function getTypeAttributes()
    {
        return $this->attributes;
    }
}
