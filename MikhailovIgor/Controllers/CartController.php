<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class CartController extends \Core\Controller{
    public function __construct()
    {
    }

    public function addToCart($productId){
        $this->loadModel("cartModel", "CarttModel");
        $cartModel->getProductByCurrentUser($productId);
        $productCollection = $this->productModel->getAllProducts();

        /*$this->data("productCollection", $productCollection);
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\HomePage.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");*/
    }

}