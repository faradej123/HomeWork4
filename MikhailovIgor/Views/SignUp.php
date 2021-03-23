<form action="<?= $actionScript ?>" method="post">
    <p>Имя(от 1 до 128 символов)</p>
    <input type="text" name="name" placeholder="Введите свое имя" value="<?= $userName ?>">
    <span><?= $userNameVerificationFail ?></span>
    <p>Email</p>
    <input type="email" name="email" placeholder="Введите свой email" value="<?= $userEmail ?>">
    <span><?= $userEmailVerificationFail ?></span>
    <p>Пароль</p>
    <input type="password" name="password" placeholder="Введите пароль">
    <span><?= $userPasswordVerificationFail ?></span><br>
    <button type="submit">Зарегистрироваться</button>
    <p><?= $message ?></p>
    <?php
        
    ?>
</form>