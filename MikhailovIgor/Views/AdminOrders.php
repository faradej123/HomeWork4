<div class = "admin-menu">
    <div><a href=<?= $urlToOrderList ?>><span>Заказы</span></a></div>
    <div><a href=<?= $urlToProductEdit ?>><span>Продукты</span></a></div>
</div>
<?php if ($orderCollection) : ?>
    <div class="order-container">
        <?php foreach ($orderCollection as $order): ?>
        <div class="order" order_id = <?= $order["order_id"] ?>>
            <div class="order_info">
                <div class="user_name">Имя пользователя: <?= $order["user_name"] ?></div>
                <div class="user_email">Email: <?= $order["email"] ?></div>
                <div class="date_created">Дата оформления заказа: <?php echo date("d-m-Y H:i:s", $order["date_created"]) ?></div> 
            </div>
            <div class="products">
                <?php foreach ($order["products"] as $product): ?>
                <div class="product">
                    <div class="product_name"><?= $product["name"] ?></div>
                    <div class="cost">Цена: <?= $product["cost"] ?></div>
                    <div class="count">Количество: <span><?= $product["count"] ?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
<div class="noproduct">
Заказов нет
</div>
<?php endif; ?>
<?php if($_SESSION["user_not_found"]) {
    echo("<p>" . $_SESSION["user_not_found"] . "</p>");
    session_unset();
} ?>