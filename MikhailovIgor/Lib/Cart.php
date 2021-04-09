<?php
namespace MikhailovIgor\Lib;

class Cart extends \Core\Entity {

    private $userId;

    public function __construct(Int $userId)
    {
        if ($userId >= 0) {
            $this->userId = $userId;
        } else {
            throw new Exception("Передан неправильный параметр в конструктор, userId должен быть числом выше 0");
        }
    }

    public function addProductToUserCart($productId)
    {
        $this->loadModel("cartModel", "CartModel");
        $isSuccessAdd =  $this->cartModel->addProductToUserCart($productId, $this->userId);
        return $isSuccessAdd;
    }

    public function getAllProductsByUserId($userId)
    {
        $this->loadModel("cartModel", "CartModel");
        $products = $this->cartModel->selectAllProductByUserId($userId);
        if (count($products)) {
            return $products;
        } else {
            return false;
        }
    }

    public function getCartsByProductId($productId)
    {
        $this->loadModel("orderModel", "OrderModel");
        $productCollection = $this->orderModel->getCartsByProductId($productId);
        return $productCollection;
    }
    
}
