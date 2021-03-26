<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\ResponseToFrontEnd;

class CartController extends \Core\Controller{

    public $message = [];

    public function __construct()
    {
    }

    public function addToCart($productId)
    {
        session_start();
        $responseToFrontEnd = new ResponseToFrontEnd();
        $userIsAuthorized = FALSE;
        if ($_SESSION["user_id"]) {
            $userId = $_SESSION["user_id"];
            $this->loadModel("userModel", "UserModel");
            $userIsAuthorized = $this->userModel->checkUserIsExist($userId);
        }

        if ($userIsAuthorized) {
            $this->loadModel("cartModel", "CartModel");
            $isSuccessAdd =  $this->cartModel->addProductToUserCart($productId, $userId);
            if (!$isSuccessAdd) {
                $responseToFrontEnd->addError("add_to_cart_fail", "Не удалось добавить товар в корзину");
            } else {
                $responseToFrontEnd->addMessage("success_added", "Товар добавлен в корзину");
                $newQty = $this->cartModel->getProductCountFromProduct($productId);
                $responseToFrontEnd->addMessage("new_product_qty", $newQty);
            }
        } else {
            $responseToFrontEnd->addError("user_not_found", "Ошибка при авторизации пользователя, залогиньтесь заново");
        }
        $responseToFrontEnd->sendJSON();
    }

}