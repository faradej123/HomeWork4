<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class SignInController extends \Core\Controller{

    private $productList = [];

    public function __construct()
    {
    }

    public function showSignInForm()
    {
        session_start();
        $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/signin/do");
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\SignIn.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

    public function doSignIn()
    {
        session_start();
    
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        if ($userPassword === '' || $userEmail === '' || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'Проверьте правильность заполненных полей';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }

        $this->loadModel("userModel", "UserModel");
        $userList = $this->userModel->getUsersByEmailAndPassword($userEmail, $userPassword);

        if (count($userList) > 0) {
            $_SESSION['user_id'] = $userList[0]["id"];
            $_SESSION['message'] = 'Авторизация прошла успешно';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
    
        } else {
            $_SESSION['message'] = 'Не верный логин или пароль';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }
    }
}