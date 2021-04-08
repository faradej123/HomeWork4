<?php
namespace MikhailovIgor\Lib;

class Product extends \Core\Entity implements \MikhailovIgor\Interfaces\iDBEntity{
    private $id;
    private $name; 
    private $cost; 
    private $count; 
    public function __construct($id = NULL, $name = NULL, $cost = NULL, $count = NULL)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setCost($cost);
        $this->setCount($count);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            return false;
        }
    }

    public function setName($name)
    {
        $name = trim($name);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        if (mb_strlen($name) > 0 && mb_strlen($name) <= 128) {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }

    public function setCost($cost)
    {
        $cost = str_replace(",", ".", $cost);
        if (!preg_match("/^0*[0-9]{1,8}(\.[0-9]{1,2}0*)?$/", $cost)) {
            return false;
        }
        $newCost = number_format((float)$cost, 2, ".", "");

        $costFloat = (float)$cost;
        if ($newCost == $costFloat && $costFloat >= 0.01 && $costFloat <= 99999999.99) {
            $this->cost = $newCost;
            return true;
        } else {
            return false;
        }
    }

    public function setCount($count)
    {
        $count = trim($count);
        if (preg_match("/^0*[0-9]{1,9}$/", $count)) {
            $this->count = $count;
            return true;
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

    public function save()
    {
        $this->loadModel("productModel", "ProductModel");
        $id = 0;
        if ($this->id == NULL || $this->id == "") {
            $id = $this->productModel->createNewProduct($this->name, $this->cost, $this->count);
        } else if ($this->id > 0) {
            $id = $this->productModel->updateProduct($this->id, $this->name, $this->cost, $this->count);
        }
        if ($id) {
            $products = $this->productModel->getProductById($id);
            if ($products) {
                $this->setId($products[0]["id"]);
                $this->setName($products[0]["name"]);
                $this->setCost($products[0]["cost"]);
                $this->setCount($products[0]["count"]);
            } else {
                return false;
            }
        } else {
            return false;
        }
        return true;
    }
}
