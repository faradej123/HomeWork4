<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class HomePageController extends \Core\Controller{
    public function __construct()
    {
    }

    public function showProducts(){
        $this->loadModel("productModel", "ProductModel");
        $productCollection = $this->productModel->getAllProducts();

        $this->data("productCollection", $productCollection);
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\HomePage.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

}