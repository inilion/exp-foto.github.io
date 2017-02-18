<?php
//require __DIR__ . '/function.php';
//session_start();
//if (!isUser()){
//	header('Location: /form.php');
//	exit;
//}
//echo 'Privet' .' ' .  $_COOKIE['auth'] . ' !';

?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8"/>
  <title>Главная</title>
  <link
       rel="stylesheet"
	   href="css/style.css"
	   type="text/css" 
	 />
  </head>
 <body>
  <h1 align="center">InILiondubRadio</h1>

  <?php include __DIR__ . '/views/box_menu.php'; ?>

  <div class="Footer">
	<footer>
	&copy MC
	</footer>
  </div>
 </body>
 </html>