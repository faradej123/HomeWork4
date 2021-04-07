<div class="product-container">
    <div class="products">
    <?php foreach ($products as $product): ?>
    <div class="product" product_id = <?= $product->getID() ?>>
        <div class="title"><?= $product->getName() ?></div>
        <div class="cost">Цена: <?= $product->getCost() ?></div>
        <div class="count">Количество: <span><?= $product->getCount() ?></span></div>
        <button>В корзину!</button>
    </div>
    <?php endforeach; ?>
    </div>
</div>