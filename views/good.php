<?php
/**
 * @var \App\models\Good $good
 */
?>
<h2>Карточка товара</h2>
Название: <?= $good->name ?> <br>
Описание: <?= $good->info ?> <br>
Цена: <?= $good->price ?> <br>
<a href="/?c=good&a=edit&id=<?= $good->id ?>">Изменить товар</a> <br>
<a href="/?c=good&a=del&id=<?= $good->id ?>">Удалить товар</a>
<hr>