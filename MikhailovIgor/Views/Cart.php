<?php if ($products) : ?>
<div class="product-container">
    <div class="products">
    <?php $allSumm = 0; ?>
    <?php foreach ($products as $product): ?>
    <div class="product" product_id = <?= $product->getID() ?>>
        <?php 
            $productSumm = $product->getCount() * $product->getCost();
            $allSumm += $productSumm;
        ?>
        <div class="title"><?= $product->getName() ?></div>
        <div class="cost">Цена за 1шт: <?= $product->getCost() ?></div>
        <div class="count">Количество: <span><?= $product->getCount() ?></span></div>
        <div class="summ">Сумма: <span><?= $productSumm ?></span></div>
    </div>
    <?php endforeach; ?>
    <div class="order">
        <div class="order-summ">Cумма всего заказа: <?= $allSumm ?></div>
        <button>Оформить заказ</button>
    </div>
    </div>
</div>
<?php endif; ?>
<?php if (!$products) : ?>
<div class="noproduct">
В корзине нет ни одного продукта
</div>
<?php endif; ?>