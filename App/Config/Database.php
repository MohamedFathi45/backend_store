<?php
namespace App\Config;

abstract class Database
{
    private $host = 'localhost';
    private $db_name = 'backend_store';
    private $username = 'root';
    private $password = '';
    public $conn;

    abstract public function connect();
    abstract public function read_products();
    abstract public function read_types();
    abstract public function read_type_attributes($id);
    abstract public function readConreteAttribues($id);
    abstract public function deleteProducts($productsId);
    abstract public function addProduct($product);

    public function get_db_name()
    {
        return $this->db_name;
    }
    public function get_dp_host()
    {
        return $this->host;
    }
    public function get_dp_username()
    {
        return $this->username;
    }
    public function get_dp_password()
    {
        return $this->password;
    }
}
