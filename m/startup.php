<?php

function startUup()
{
	// Настройки подключения к БД.
	$hostname = 'localhost';

	$username = 'root'; 
	$password = '1234';
	$dbName = 'expert';
	
	// Языковая настройка.
	setlocale(LC_ALL, 'UTF-8');
	
	// Подключение к БД.
	mysql_connect($hostname, $username, $password) or die('No connect with data base'); 
	mysql_query('SET NAMES UTF-8');
	mysql_select_db($dbName) or die('No data base');

	// Открытие сессии.
	session_start();		
}
