<?php session_start(); ?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8"/>
  <title>Главная</title>
  <link
       rel="stylesheet"
	   href="../css/style.css"
	   type="text/css" 
	 />
  </head>
 <body>
 

  <h1 align="center">Главная</h1>
	<main class="main1">
		<div class="registration_form">
		

		
			<form action="/models/user.php" method="post">
					<input type="text"  name="login">
					<input type="password" name="password">
					<input type="submit" value="Войти">
			</form>
		</div>

	</main>
	<footer>
	&copy MC
	</footer>
 </body>
 </html>