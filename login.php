<?php
require "db.php";
$data = $_POST;

if (isset($data['submit_login'])) {
	$errors = array();
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ($user) {
		if (md5($data['password']) == $user->password) {
			$_SESSION['logged_user'] = $user;
			header('Location: /');
		}
		else {
			$errors[] = 'Пароль или логин введён неверно';
		}
	}
	else {
		$errors[] = 'Пользователь с таким логином не найден';
	}

	if ( ! empty($errors)) {
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
	<form action="login.php" method="POST" class="form">
		<div class="form-title">Авторизация</div>
		Логин <input name="login" type="text" value="<?php echo @$data['login']?>"><br>
		Пароль <input name="password" type="password"><br>
		<input name="submit_login" type="submit" value="Войти">
	</form>
</div>
</body>
</html>