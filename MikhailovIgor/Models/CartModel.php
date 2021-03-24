<?php
namespace MikhailovIgor\Models;


class CartModel extends \Core\Model{//TO DO
    public function addProductToUserCart($productId, $userId)
    {

        $productInCart = $this->selectProductFromCartByProductAndUser($productId, $userId);

        if (empty($productInCart)) {
            $this->insertNewProductInCart($productId, $userId)
        } else {
            $this->updateProductCountInCart($cartId["id"])
        }
        $stmt = $this->pdo->prepare("INSERT INTO `cart` (`user_id`, `product_id`, `count`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->bindParam(3, $count);
        $stmt->execute();
    }

    public function updateProductCountInCart($cartId)
    {
        $stmt = $this->pdo->prepare("UPDATE `cart` SET");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->bindParam(3, $count);
        $result = $stmt->execute();
        return $result;
    }

    public function insertNewProductInCart($productId, $userId)
    {
        $count = 1;
        $stmt = $this->pdo->prepare("INSERT INTO `cart` (`user_id`, `product_id`, `count`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->bindParam(3, $count);
        $result = $stmt->execute();
        return $result;
    }

    public function selectProductFromCartByProductAndUser($productId, $userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `cart` WHERE `user_id` = ? AND `product_id` = ? LIMIT 1");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->bindParam(3, $count);
        $stmt->execute();
        $productInCart = $stmt->fetchAll();
        return $productInCart;
    }



    
}