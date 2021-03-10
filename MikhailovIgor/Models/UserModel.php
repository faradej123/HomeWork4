<?php
namespace MikhailovIgor\Models;
use MikhailovIgor\Lib\DBConnector;

class UserModel{
    public function getUsersByEmail($userEmail)
    {
        $pdo = DBConnector::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `email` =  ?");
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function getUsersByEmailAndPassword($userEmail, $userPassword)
    {
        $pdo = DBConnector::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `email` =  ? AND `password` = ?" );
        $stmt->bindParam(1, $userEmail);
        $stmt->bindParam(2, md5($userPassword));
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function insertNewUser($userName, $userEmail, $userPassword)
    {
        $pdo = DBConnector::getPdo();
        $userPassword = md5($userPassword);
        $stmt = $pdo->prepare("INSERT INTO `user` (`firstname`, `email`, `password`, `date_created`) VALUES (?, ?, ?, ?)");//вывести в модель
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $userEmail);
        $stmt->bindParam(3, $userPassword);
        $stmt->bindParam(4, time());
        $stmt->execute();
    }
}