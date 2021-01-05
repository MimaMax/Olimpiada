<?php
	require "db.php";

	$data = $_POST;
	if (isset($data['submit_signin'])) {
	$errors = array();

	if (trim($data['login']) == '') {
		$errors[] = 'Введите логин!';
	}
	if ($data['password'] == '') {
		$errors[] = 'Введите пароль';
	}
	if ($data['password_2'] != $data['password']) {
		$errors[] = 'Повторный пароль введен неверно';
	}
	if (R::count('users', "login = ?",array($data['login']))>0) {
		$errors[] = 'Пользователь с таким логином уже существует';
	}
	if (empty($errors)) {
	$user = R::dispense('users');
	$user->rol = $data['rol'];
	$user->login = $data['login'];
	$user->password = md5($data['password']);
	R::store($user);
	echo '<div class="centrovka"><div class="correct">Вы успешно зарегистрировались<a href="login.php"><div class="button_correct">Авторизация</div></a></div></div>';
	}//массив ошибок пуст, можно отправлять форму
	else {
	echo '<div class="errors">'.array_shift($errors).'</div>';
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Olimpiada</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="line">
	<form action="signin.php" method="POST" class="form">
		<div class="form-title">Регистрация</div>
		Роль <select name="rol">
    	<option value="manager">Менеджер</option>
    	<option value="supervizer">Супервайзер</option>
    	<option value="promouter" selected>Промоутер</option>
   		</select> 
		Введите логин <input name="login" type="text" value="<?php echo @$data['login']?>"><br>
		Введите пароль <input name="password" type="password" value="<?php echo @$data['password']?>"><br>
		Введите пароль еще раз <input name="password_2" type="password"><br>
		<input name="submit_signin" type="submit" value="Зарегистрироваться" id="send_sign">
	</form>
</div>
</body>
</html>