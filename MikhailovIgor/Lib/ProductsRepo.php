<?php
namespace MikhailovIgor\Lib;

class ProductsRepo extends \Core\Entity {


    public function __construct(){
    }

    public function getAllProducts()
    {
        $this->loadModel("productModel", "ProductModel");
        $productCollection = $this->productModel->getAllProducts();
        return $productCollection;
    }
}
