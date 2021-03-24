<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class CartController extends \Core\Controller{
    public function __construct()
    {
    }

    public function addToCart($productId){
        session_start();
        $userIsAuthorized = FALSE;
        if ($_SESSION["user_id"]) {
            $userId = $_SESSION["user_id"];
            $this->loadModel("userModel", "UserModel");
            $userIsAuthorized = $this->userModel->checkUserIsExist($userId);
        }

        if ($userIsAuthorized) {
            $this->loadModel("cartModel", "CartModel");
            $this->cartModel->addProductToUserCart($productId, $userId);
        } else {
            session_unset();
            $_SESSION["user_not_found"] = "Ошибка при авторизации пользователя, залогиньтесь заново";
        }

        //$cartModel->getProductByCurrentUser($productId);
        //$productCollection = $this->productModel->getAllProducts();

        /*$this->data("productCollection", $productCollection);
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\HomePage.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");*/
    }

}