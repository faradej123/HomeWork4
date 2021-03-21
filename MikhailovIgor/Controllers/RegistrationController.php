<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;


class RegistrationController extends \Core\Controller{

    public function __construct()
    {
    }

    public function showRegistrationForm()
    {
        session_start();
        $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/registration/do");
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\Registration.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

    public function doRegistration()
    {
        session_start();
        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $this->loadModel("userModel", "UserModel");
        $userList = $this->userModel->getUsersByEmail($userEmail);

        if (count($userList) > 0) {
            $_SESSION['message'] = 'Такой пользователь уже существует';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/registration');
        } else if ($userPassword === '' || $userName === '' || $userEmail === '' || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'Проверьте правильность заполненных полей';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/registration');
        } else {
            $this->userModel->insertNewUser($userName, $userEmail, $userPassword, 2);
            $_SESSION['message'] = 'Пользователь успешно зарегистрирован';
            header('Location: https://' . $_SERVER['SERVER_NAME'] . '/signin');
        }
    }
}