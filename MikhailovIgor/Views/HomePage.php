<div class="product-container">
<?php foreach ($productCollection as $product): ?>
<div class="product" product_id = <?= $product->getID() ?>>
    <div class="title"><?= $product->getName() ?></div>
    <div class="cost">Цена: <?= $product->getCost() ?></div>
    <div class="count">Количество: <?= $product->getCount() ?></div>
    <button>В корзину!</button>
</div>
<?php endforeach; ?>
</div>
<?php if($_SESSION["user_not_found"]) {
    echo("<p>" . $_SESSION["user_not_found"] . "</p>");
} ?>