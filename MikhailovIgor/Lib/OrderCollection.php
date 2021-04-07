<?php
namespace MikhailovIgor\Lib;

class OrderCollection extends \Core\Entity implements \MikhailovIgor\Interfaces\iDBCollection {


    public function __construct(){
    }

    public function getAll()
    {
        $this->loadModel("orderModel", "OrderModel");
        $orderCollection = $this->orderModel->getAllOrders();
        return $orderCollection;
    }

    public function getProductsById($productId)
    {
        $this->loadModel("orderModel", "OrderModel");
        $productCollection = $this->orderModel->getProductsById($productId);
        return $productCollection;
    }
}
