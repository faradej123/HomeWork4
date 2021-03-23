<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;


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
        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $userName = trim($userName);
        $isLatinName = preg_match("/^([A-Za-z]+\s?([A-Za-z]+\s?)*)$/", $userName);
        $isRussianName = preg_match("/^([А-Яа-яЁё]+\s?([А-Яа-яЁё]+\s?)*)$/u", $userName);
        $isValidUserName = FALSE;
        if($isLatinName && strlen($userName) > 0 && strlen($userName) <= 128) {
            $isValidUserName = TRUE;
        } else if ($isRussianName && mb_strlen($userName) > 0 && mb_strlen($userName) <= 128) {
            $isValidUserName = TRUE;
        } else {
            $_SESSION['userNameVerificationFail'] = "Имя пользователя должно состоять только из латинских или только из букв киррилицы, а так же состоять из количества символов в диапазано от 1 до 128";
            //setcookie("userNameVerificationFail", "Имя пользователя должно состоять только из латинских или только из букв киррилицы, а так же состоять из количества символов в диапазано от 1 до 128", time()+3600);
        }
        $_SESSION['userName'] = $userName;
        //setcookie("userName", $userName, time()+3600);

        $userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
        if (!$userEmail) {
            $_SESSION['userEmailVerificationFail'] = "Email пользователя не соответствует правильному формату";
            //setcookie("userEmailVerificationFail", "Email пользователя не соответствует правильному формату", time()+3600);
            $isValidEmail = FALSE;
        } else {
            $isValidEmail = TRUE;
        }
        $_SESSION['userEmail'] = $userEmail;
        //setcookie("userEmail", $userEmail, time()+3600);

        $isValidPassword = preg_match("/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/", $userPassword);
        if ($isValidPassword) {
            strlen($userPassword) <= 128 ? TRUE : FALSE;
        }
        if(!$isValidPassword) {
            $_SESSION['userPasswordVerificationFail'] = "Пароль не соответствует правильному формату, он должен состоять минимум из6 символов, которые включают себя латинские буквы нижнего и верхнего регистра, цифры и символы";
            //setcookie("userPasswordVerificationFail", "Пароль не соответствует правильному формату, он должен состоять минимум из6 символов, которые включают себя латинские буквы нижнего и верхнего регистра, цифры и символы", time()+3600);
        }

        $this->loadModel("userModel", "UserModel");
        $userList = $this->userModel->getUsersByEmail($userEmail);

        if (count($userList) > 0) {
            //setcookie("message", "Такой пользователь уже существует", time()+3600);
            $_SESSION['message'] = 'Такой пользователь уже существует';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signup');
        } else if (!$isValidPassword || !$isValidUserName || !$isValidEmail) {
            //$_SESSION['message'] = 'Проверьте правильность заполненных полей';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signup');
        } else {
            $this->userModel->insertNewUser($userName, $userEmail, $userPassword);
            //setcookie("message", "Пользователь успешно зарегистрирован", time()+3600);
            $_SESSION['message'] = 'Пользователь успешно зарегистрирован';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }
    }
}