<?php
namespace MikhailovIgor\Lib;

class ProductCollection extends \Core\Entity implements \MikhailovIgor\Interfaces\iDBCollection {


    public function __construct(){
    }

    public function getAll()
    {
        $this->loadModel("productModel", "ProductModel");
        $productCollection = $this->productModel->getAllProducts();
        return $productCollection;
    }
}
