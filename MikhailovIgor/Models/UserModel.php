<?php
namespace MikhailovIgor\Models;

class UserModel extends \Core\Model{

    public function getUsersByEmail($userEmail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` =  ?");
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function getUsersByEmailAndPassword($userEmail, $userPassword)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` =  ? AND `password` = ?" );
        $stmt->bindParam(1, $userEmail);
        $stmt->bindParam(2, md5($userPassword));
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function insertNewUser($userName, $userEmail, $userPassword)
    {
        $userPassword = md5($userPassword);
        $role = "2";
        $stmt = $this->pdo->prepare("INSERT INTO `user` (`firstname`, `email`, `password`, `date_created`, `role_id`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $userEmail);
        $stmt->bindParam(3, $userPassword);
        $stmt->bindParam(4, time());
        $stmt->bindParam(5, $role);
        $stmt->execute();
    }
}