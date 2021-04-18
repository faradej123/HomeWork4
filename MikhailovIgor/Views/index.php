<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <title>Интернет магазин</title>
    <link rel="stylesheet" href=<?= "https://" . $_SERVER['SERVER_NAME'] . "/css/style.css" ?>>
    <script src=<?= "https://" . $_SERVER['SERVER_NAME'] . "/js/Main.js" ?>></script>
    <?php
        if (!empty($jsScripts)) {
            foreach ($jsScripts as $scriptPath) {
                echo "<script src='". $scriptPath ."'></script>";
            }
        }
    ?>
</head>
<body>
<header>
    <div class="menu">
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . ">На главную!</a>" ?></div>

    </div>
    <div class="userPanel">
        <?php 
        if (!$user_name) {
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signup/><div>Регистрация</div></a>";
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signin/><div>Ввойти</div></a>";
        }
        if ($user_name) {
            echo "<div>Авторизован пользователь: <b>" . $_SESSION['name'] . "</b></div>";
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/cart/><div>Корзина</div></a>";
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signout/><div>Выйти</div></a>";
        }
        if ($user_role == "Admin") {
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/admin/><div>Админ-панель</div></a>";
        }
        ?>
    </ul>
</header>
<div class="wrapper">
    <?php require_once($template); ?>
</div>
<footer></footer>
</body>
</html>