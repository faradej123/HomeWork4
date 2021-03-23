<?php foreach ($productCollection as $product): ?>
<div>
    <div><?= $product->getName() ?></div>
    <div><?= $product->getCost() ?></div>
    <div><?= $product->getCost() ?></div>
</div>
<?php endforeach; ?>