<?php
namespace MikhailovIgor\Lib;

class OrderCollection extends \Core\Entity implements \MikhailovIgor\Interfaces\iCollection {


    public function __construct(){
    }

    public function getAll()
    {
        $this->loadModel("orderModel", "OrderModel");
        $orderCollection = $this->orderModel->getAllOrders();
        return $orderCollection;
    }
}
