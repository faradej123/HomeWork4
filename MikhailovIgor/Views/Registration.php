<form action="<?= $actionScript ?>" method="post">
    <p>Имя</p>
    <input type="text" name="name" placeholder="Введите свое имя">
    <p>Email</p>
    <input type="email" name="email" placeholder="Введите свой email">
    <p>Пароль</p>
    <input type="password" name="password" placeholder="Введите пароль"><br><br>
    <button type="submit">Зарегистрироваться</button>
    <?php
        if ($_SESSION['message']) {
            echo '<p>' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
    ?>
</form>