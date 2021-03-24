<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <title>My Page Title</title>
    <link rel="stylesheet" href=<?= "https://" . $_SERVER['SERVER_NAME'] . "/css/style.css" ?>>
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
    <?php 
        if ($_SESSION["firstname"]) {
            echo "<div>Авторизован пользователь: <b>" . $_SESSION['firstname'] . "</b></div>";
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signout/><button>Выйти</button></a>";
        }
    ?>
    <ul class="menu">
        <li><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signup/>Регистрация</a>" ?></li>
        <li><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signin/>Ввойти</a>" ?></li><br>
        <li><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/xml/>Експорт в XML</a>" ?></li>
        <li><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/json/>Експорт в JSON</a>" ?></li>
        <li><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/csv/>Експорт в CSV</a>" ?></li>
    </ul>
</header>
<div class="wrapper">
    <?php require_once($template); ?>
</div>
<footer></footer>
</body>
</html>