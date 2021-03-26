<?php
namespace MikhailovIgor\Models;


class CartModel extends \Core\Model{//TO DO
    public function addProductToUserCart($productId, $userId)
    {
        $this->pdo->beginTransaction();

        $productInCart = $this->selectProductFromCartByProductAndUser($productId, $userId);

        if (empty($productInCart)) {
            $productIsAded = $this->insertNewProductInCart($productId, $userId);
        } else {
            $productIsAded = $this->updateProductCountInCart($productInCart[0]["id"], ++$productInCart[0]["count"]);
        }
        if ($productIsAded) {
            $productCount = $this->getProductCountFromProduct($productId);
            if ($productCount > 0) {
                $updateResult = $this->updateProductCountInProduct($productId, --$productCount);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
        $this->pdo->commit();
        return TRUE;
    }

    public function updateProductCountInCart($cartId, $productCount)
    {
        $stmt = $this->pdo->prepare("UPDATE `cart` SET `count` = ? WHERE `id` = ?");
        $stmt->bindParam(1, $productCount);
        $stmt->bindParam(2, $cartId);
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
        $stmt->execute();
        $productInCart = $stmt->fetchAll();
        return $productInCart;
    }

    public function getProductCountFromProduct($productId)
    {
        $stmt = $this->pdo->prepare("SELECT `count` FROM `product` WHERE `id` = ? LIMIT 1");
        $stmt->bindParam(1, $productId);
        $stmt->execute();
        $productCount = $stmt->fetchAll();
        if (count($productCount)) {
            return $productCount[0]["count"];
        } else {
            return false;
        }
    }

    public function updateProductCountInProduct($productId, $productCount)
    {
        $stmt = $this->pdo->prepare("UPDATE `product` SET `count` = ? WHERE `id` = ?");
        $stmt->bindParam(1, $productCount);
        $stmt->bindParam(2, $productId);
        $result = $stmt->execute();
        return $result;
    }
    
}