<div class = "admin-menu">
    <div><a href=<?= $urlToOrderList ?>><span>Заказы</span></a></div>
</div>
<div class="product-container">
    <div class="products">
    <?php foreach ($products as $product): ?>
    <div class="product" product_id = <?= $product->getID() ?>>
        <div class="title"><span><?= $product->getName() ?></span></div>
        <div class="cost">Цена: <span><?= $product->getCost() ?></span></div>
        <div class="count">Количество: <span><?= $product->getCount() ?></span></div>
        <button>Удалить!</button>
    </div>
    <?php endforeach; ?>
    </div>
</div>
<div id="create-product-form">
    Форма создания продукта<br>
    Название: <input type="text" name="product-name">от 1 до 128 символов<br>
    Цена: <input type="text" name="product-cost">от 0.01 до 99999999.99<br>
    Количество: <input type="text" name="product-count"> от 0 до 999999999<br>
    <button>Создать</button>
</div>