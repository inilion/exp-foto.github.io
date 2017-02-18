<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//RU">
<html>
<head>
	<title><?=$title?></title>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
	<script type="text/javascript" src="/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="/jquery.cross-slide.js"></script>




</head>
<body>

<script type="text/javascript">
	function parallax(){
		var scrolled = $(window).scrollTop();
		$('.bg').css('top',-(scrolled*0.2)+'px');
	}
</script>
<script type="text/javascript">
	$(window).scroll(function(e){
		parallax();
	});
	</script>
<div class="bg"> </div>

	<div class="header" id="up">

		<a href="/index.php" title="На главную" >
			<div class="Label">
				<img src="/img_exp/PhotoObectiv.png" alt="laible">
			</div>
		</a>

		<?php if ($user == null): ?>



			<?php echo '

    <div class="Box_Auth">
        <form action="/auth/login" method = "post" enctype = "multipart/form-data" >


	Логин:
	<br/>
	<input name="login" type="text" value=""/>
	<br/>
	Пароль:
	<br/>
	<input name="password" type="password"/>
	<br/>
	<input type="checkbox" name="remember" /> запомнить меня
	<br/>
	<input class="AllTypes" type="submit" value="Войти"/>

</form>
<button class="AllTypesLOGOUT" ><a href = "/reg/reg" >Регистрация</a ></button >
        </div>'
			?>
		<?php endif ?>

		<?php if ($user != null): ?>
			<?php echo'<div class="UserLoginIn">'?>
			<?php echo '<span class="UserLogin">' . $user['login'] . '</span>'?>
				<button class = "AllTypes"><a href = "/cart/index" >Моя корзина</a></button >
			<?php	if($can_use){
				echo'<button class = "AllTypes"><a href = "/order/view_orders" >Заказы</a></button >';
			}?>
				<button class = "AllTypes" ><a href = "/auth/logout" >Выход</a></button >
			<?php echo'</div>'?>
		<?php endif ?>
		<?php include __DIR__ . './../views/box_menu.php';?>
		<?php
		if ($can_use){
			include __DIR__ . './../views/BOX_Super_User.php';
		}
		?>
		<h1><?=$title?></h1>

	</div>



	</a>
	<div id="content">
		<?=$content?>
	</div>



	<div id="footer">
		&copy; Фото-салон Expert-Фото : т.8-900-999-99-99
	</div>
</body>
</html>
