<div class="product-container">
<?php foreach ($productCollection as $product): ?>
<div class="product">
    <div class="title"><?= $product->getName() ?></div>
    <div class="cost">Цена: <?= $product->getCost() ?></div>
    <div class="count">Количество: <?= $product->getCount() ?></div>
    <a href="<?= "https://" . $_SERVER['HTTP_HOST'] . "/cart/addproduct/". $product->getID() ?>"><button>В корзину!</button></a>
</div>
<?php endforeach; ?>
</div>