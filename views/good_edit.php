<?php
/**
 * @var \App\models\Good $good
 */
?>
<p>Изменение товара</p>
<form action="" method="post">
    <input type="text" value="<?=$good->name?>" name="name">
    <input type="number" value="<?=$good->price?>" name="price">
    <input type="submit">
</form>