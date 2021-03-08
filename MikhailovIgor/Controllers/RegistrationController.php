<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\DBConnector;

class RegistrationController extends \Core\Controller{

    private $productList = [];

    public function __construct()
    {
    }

    public function showRegistrationForm()
    {
        $this->data("actionScript", "https://HomeWork4/registration/do");
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\Registration.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

    public function doRegistration()
    {
        session_start();
        $pdo = DBConnector::getPdo();

        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `login` =  ?");//вывести в модель
        $stmt->bindParam(1, $userName);
        $stmt->execute();
        $userList = $stmt->fetchAll();

        if (count($userList) > 0) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Такой логин уже существует",
                "fields" => ['login']
            ];
        
            echo json_encode($response);
            die();
        }
        
        $error_fields = [];

        if ($userPassword === '') {
            $error_fields[] = 'password';
        }
        
        if ($userName === '') {
            $error_fields[] = 'full_name';
        }
        
        if ($userEmail === '' || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $error_fields[] = 'email';
        }
        
        if (!empty($error_fields)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Проверьте правильность полей",
                "fields" => $error_fields
            ];
        
            echo json_encode($response);
        
            die();
        }
    
        $userPassword = md5($userPassword);
    
        $stmt = $pdo->prepare("INSERT INTO `user` (`firstname`, `email`, `password`, `date_created`) VALUES (?, ?, ?, ?)");//вывести в модель
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $userEmail);
        $stmt->bindParam(3, $userPassword);
        $stmt->bindParam(4, time());
        $stmt->execute();

        $response = [
            "status" => true,
            "message" => "Регистрация прошла успешно!",
        ];
        echo json_encode($response);
    }
}