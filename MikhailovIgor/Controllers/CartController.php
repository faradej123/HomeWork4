<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\ResponseToFrontEnd;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\CartCollection;
use MikhailovIgor\Lib\Cart;
use MikhailovIgor\Lib\OrderRepo;

class CartController extends \Core\Controller{

    public $message = [];

    public function __construct()
    {
    }

    public function addToCart($productId)
    {
        $user = new User();
        $user->initUserFromSession();
        $responseToFrontEnd = new ResponseToFrontEnd();
        if ($user->checkForExistInDB()) {
            $cart = new Cart($user->getId());
            $isSuccessAdd = $cart->addProductToUserCart($productId);
            if (!$isSuccessAdd) {
                $responseToFrontEnd->addError("add_to_cart_fail", "Не удалось добавить товар в корзину");
            } else {
                $responseToFrontEnd->addMessage("success_added", "Товар добавлен в корзину");
                $this->loadModel("cartModel", "CartModel");
                $newQty = $this->cartModel->getProductCountFromProduct($productId);
                $responseToFrontEnd->addMessage("new_product_qty", $newQty);
            }
        } else {
            $responseToFrontEnd->addError("user_not_found", "Ошибка при авторизации пользователя, залогиньтесь заново");
        }
        $responseToFrontEnd->sendJSON();
    }

    public function showCart()
    {
        $user = new User();
        $user->initUserFromSession();
        if ($userId = $user->getId()) {
            $cart = new CartCollection($userId);
            $product = $cart->getAllProductsFromUserCartByUserId($userId);
            $this->addJs("cart.js");
            $this->data("products", $product);
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\Cart.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }

    public function confirmOrder()
    {
        $response = new ResponseToFrontEnd();
        $user = new User();
        $user->initUserFromSession();
        if ($userId = $user->getId()) {
            $order = new OrderRepo($userId);
            $result = $order->confirmOrder();
            if (!$result) {
                $response->addError("order_confirm", "Ошибка при подтверждении заказа");
            } else {
            $response->addMessage("order_confirmed", "Заказ успешно подтвержден");
            }
        } else {
            $response->addError("user_error", "Ошибка при авторизации");
        }
        $response->sendJSON();
    }

}