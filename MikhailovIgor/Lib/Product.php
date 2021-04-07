<?php
namespace MikhailovIgor\Lib;

class Product extends \Core\Entity implements \MikhailovIgor\Interfaces\iDBEntity{
    private $id;
    private $name; 
    private $cost; 
    private $count; 
    public function __construct($id = NULL, $name = NULL, $cost = NULL, $count = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->count = $count;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(Int $id)
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            return false;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function delete()
    {
        try {
            if ($this->id <= 0) {
                throw new Exception("Id is incorrrect");
            }
            $this->loadModel("productModel", "ProductModel");
            $result = $this->productModel->deleteProductById($this->id);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return FALSE;
        }
    }
}
