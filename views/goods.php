<?php
/**
 * @var \App\models\Good[] $goods
 */
?>
    <h2>Товары</h2>

<?php foreach ($goods as $good) : ?>
    <a href="/?c=good&a=one&id=<?=$good->id?>">Название: <?= $good->name ?></a> <br>
    Описание: <?= $good->info ?> <br>
    Цена: <?= $good->price ?>
    <hr>
<?php endforeach; ?>