<?php
namespace MikhailovIgor\Models;

use MikhailovIgor\Lib\Product;

class ProductModel extends \Core\Model{
    
    public function getAllProducts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `product`");
        $stmt->execute();
        $productCollection = [];
        while($productRow = $stmt->fetch()) {
            $productCollection[] = new Product($productRow["id"], $productRow["name"], $productRow["cost"], $productRow["count"]);
        }
        return $productCollection;
    }

    public function addProductToCart($productId)
    {
        $userPassword = md5($userPassword);
        $role = "2";
        $stmt = $this->pdo->prepare("INSERT INTO `user` (`firstname`, `email`, `password`, `date_created`, `role_id`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $userEmail);
        $stmt->bindParam(3, $userPassword);
        $stmt->bindParam(4, time());
        $stmt->bindParam(5, $role);
        $stmt->execute();
    }
}