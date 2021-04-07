<?php
namespace MikhailovIgor\Lib;

class CartCollection extends \Core\Entity {

    private $userId;

    public function __construct()
    {

    }


    public function getCartsByProductId ($productId) {
        $this->loadModel("cartrModel", "CartModel");
        $cartCollection = $this->cartrModel->getCartsByProductId($productId);
        return $cartCollection;
    }

}
