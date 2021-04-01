<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\User;

class SignUpController extends \Core\Controller{

    public function __construct()
    {
    }

    public function showRegistrationForm()
    {
        session_start();
        if ($_SESSION['userName']) {
            $this->data("userName", $_SESSION['userName']);
            unset($_SESSION['userName']);
        }
        if ($_SESSION['userNameVerificationFail']) {
            $this->data("userNameVerificationFail", $_SESSION['userNameVerificationFail']);
            unset($_SESSION['userNameVerificationFail']);
        }
        if ($_SESSION['userEmail']) {
            $this->data("userEmail", $_SESSION['userEmail']);
            unset($_SESSION['userEmail']);;
        }
        if ($_SESSION['userEmailVerificationFail']) {
            $this->data("userEmailVerificationFail", $_SESSION['userEmailVerificationFail']);
            unset($_SESSION['userEmailVerificationFail']);
        }
        if ($_SESSION['userPasswordVerificationFail']) {
            $this->data("userPasswordVerificationFail", $_SESSION['userPasswordVerificationFail']);
            unset($_SESSION['userPasswordVerificationFail']);
        }
        if ($_SESSION['message']) {
            $this->data("message", $_SESSION['message']);
            unset($_SESSION['message']);
        }
        $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/signup/do");
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\signup.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

    public function doRegistration()
    {
        session_start();
        $user = new User();

        if (!$user->setName($_POST['name'])) {
            $_SESSION['userNameVerificationFail'] = "Имя пользователя должно состоять только из латинских или только из букв киррилицы, а так же состоять из количества символов в диапазано от 1 до 128";
        }
        $_SESSION['userName'] = $_POST['name'];

        if (!$user->setEmail($_POST['email'])) {
            $_SESSION['userEmailVerificationFail'] = "Email пользователя не соответствует правильному формату";
        }
        $_SESSION['userEmail'] = $_POST['email'];

        if (!$user->setPassword($_POST['password'])) {
            $_SESSION['userPasswordVerificationFail'] = "Пароль не соответствует правильному формату, он должен состоять минимум из 6 символов, которые включают себя латинские буквы нижнего и верхнего регистра, цифры и символы";
        }

        if ($user->checkForExistInDB()) {
            $_SESSION['userEmailVerificationFail'] = 'Пользователь с таким емейлом уже существует';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signup');
        } else if (!$user->getPassword() || !$user->getName() || !$user->getEmail()) {
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signup');
        } else {
            if ($user->signUp()) {
                $_SESSION['message'] = 'Пользователь успешно зарегистрирован';
                header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
            } else {
                $_SESSION['message'] = 'Что-то пошло не так :( . Попробуйте еще раз';
                header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signup');
            }
        }
    }
}