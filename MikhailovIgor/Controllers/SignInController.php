<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\User;

class SignInController extends \Core\Controller{

    public function __construct()
    {
    }

    public function showSignInForm()
    {
        $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/signin/do");
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\SignIn.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

    public function doSignIn()
    {
        session_start();
        $user = new User($_POST['email'], $_POST['password']);
        if (!$user) {
            $_SESSION['message'] = 'Проверьте правильность заполненных полей';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }
        if ($user->signIn()) {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        } else {
            $_SESSION['message'] = 'Не верный логин или пароль';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }
    }
}