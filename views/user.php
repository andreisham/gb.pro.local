<?php
/**
 * @var \App\models\User $user
 */
?>
<h2>Пользователь</h2>
логин: <?= $user->login ?> <br>
<a href="/?c=user&a=edit&id=<?= $user->id ?>">Изменить пользователя</a>
<hr>

