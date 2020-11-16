<?php
/**
 * @var \App\models\User[] $users
 */
?>
<h2>Пользователи</h2>

<?php foreach ($users as $user) : ?>
    <a href="/?c=user&a=one&id=<?=$user->id?>">логин: <?= $user->login ?></a>
    <hr>
<?php endforeach; ?>
