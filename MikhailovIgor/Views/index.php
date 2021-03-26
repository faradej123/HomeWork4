<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <title>Интернет магазин</title>
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
    <div class="menu">
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . ">На главную!</a>" ?></div>
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/xml/>Експорт в XML</a>" ?></div>
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/json/>Експорт в JSON</a>" ?></div>
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/export/csv/>Експорт в CSV</a>" ?></div>
    </div>
    <div class="userPanel">
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signup/>Регистрация</a>" ?></div>
        <div><?= "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signin/>Ввойти</a>" ?></div><br><?php 
        if ($_SESSION["firstname"]) {
                echo "<div>Авторизован пользователь: <b>" . $_SESSION['firstname'] . "</b></div>";
            echo "<a href=https://" . $_SERVER['HTTP_HOST'] . "/signout/><div>Выйти</div></a>";
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