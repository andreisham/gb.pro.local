<?php
/**
 * @var \App\models\User $user
 */
?>
<p>Изменение пользователя</p>
<form action="" method="post">
    <input type="text" value="<?=$user->login?>" name="login">
    <input type="password" name="password">
    <input type="submit">
</form>