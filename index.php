<?php
	require "db.php";
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Olimpiada</title>
	<link rel="stylesheet" href="style.css">
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
    </script>	
</head>
<body>

<!--LOGGED LIKE manager-->
<?php if ( isset($_SESSION['logged_user']) and $_SESSION['logged_user']->rol  == 'manager') : ?>
<?php

	$data = $_POST;
	if (isset($data['submit_write'])) {
	$errors = array();

	if (trim($data['company_name_write']) == '') {
		$errors[] = 'Введите имя компании!';
	}
	if ($data['company_date_write'] == '') {
		$errors[] = 'Введите дату';
	}
	if ($data['company_promouter_write'] == '') {
		$errors[] = 'Введите количество промоутеров';
	}

	if (empty($errors)) {
	$company = R::dispense('company');
	$company->company_name = $data['company_name_write'];
	$company->start_date = $data['company_date_write'];
	$company->promouter_need = $data['company_promouter_write'];
	R::store($company);
	echo '<div class="centrovka-write"><div class="correct-write">Новая акция зарегистрированна</div></div>';
	}//массив ошибок пуст, можно отправлять форму
	else {
	echo '<div class="errors">'.array_shift($errors).'</div>';
	}
}
?>
<div class="header-healh">
	<header>
			<h1>Привет <?php echo $_SESSION['logged_user']->login;?>! &nbsp &nbsp Ваша роль: Менеджер</h1><a href="logout.php"><p>Выход</p></a>
	</header>
</div>
<div class="list-container">
	<div class="list">
		<div class="list-title">Список акций промоуторского агентства "МЫ"</div>
		<div class="list-info">
			<div class="list-write">
				<form action="index.php" method="POST" class="form-write">
					<div class="container-write">
						<p>Кнопка записи</p>
						<input name="submit_write" type="submit" value="Записать" id="btn">
					</div>
					<div class="container-write">
						<p>Название компании</p> 
						<input name="company_name_write" type="text" >
					</div>
					<div class="container-write">
						<p>Дата начала</p>
						<input name="company_date_write" type="date" >
					</div>
					<div class="container-write">
						<p>Число промоутеров</p>
						<input name="company_promouter_write" type="number" >
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--LOGGED LIKE supervizer-->
<?php elseif ( isset($_SESSION['logged_user']) and $_SESSION['logged_user']->rol == 'supervizer') : ?>
<div class="header-healh">
	<header>
			<h1>Привет <?php echo $_SESSION['logged_user']->login;?>! &nbsp &nbsp Ваша роль: Супервайзер</h1><a href="logout.php"><p>Выход</p></a>
	</header>
</div>
<div class="list-container">
	<div class="list">
		<div class="list-title">Список акций промоуторского агентства "МЫ"</div>
		<div class="list-info">
			<div class="list-write">
				<form action="index.php" method="POST">
					<button></button>
					<input type="text">
					<input type="text">
					<input type="text">
				</form>
			</div>
		</div>
	</div>
</div>

<!--LOGGED LIKE promouter-->
<?php elseif ( isset($_SESSION['logged_user']) and $_SESSION['logged_user']->rol == 'promouter') : ?>
<div class="header-healh">
	<header>
			<h1>Привет <?php echo $_SESSION['logged_user']->login;?>! &nbsp &nbsp Ваша роль: Промоутер</h1><a href="logout.php"><p>Выход</p></a>
	</header>
</div>
<div class="list-container">
	<div class="list">
		<div class="list-title">Список акций промоуторского агентства "МЫ"</div>
		<div class="list-info">
			<div class="list-write">
				<form action="index.php" method="POST">
					<button></button>
					<input type="text">
					<input type="text">
					<input type="text">
				</form>
			</div>
		</div>
	</div>
</div>


<?php else : ?>
<div class="line">

	<div class="form">
		<div class="form-title">Авторизуйтесь!</div>
		<a href="signin.php"><div class="signin">Регистрация</div></a>
		<a href="login.php"><div class="login">Войти</div></a>
	</div>
</div>
<?php endif; ?>

</body>
</html>