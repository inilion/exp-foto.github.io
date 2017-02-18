<?php
session_start();
function __autoload($classname){
	switch($classname[0])
	{
		case 'C':
			include_once("c/$classname.php");
			break;
		case 'M':
			include_once("m/$classname.php");
			break;
	}
}

define('BASE_URL', '/');

define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '1234');
define('MYSQL_DB', 'expert');

$info = explode('/', $_GET['q']);
$params = array();

foreach ($info as $v)
{
	if ($v != '')
		$params[] = $v;
}

$action = 'action_';
$action .= (isset($params[1])) ? $params[1] : 'index';

switch ($params[0])
{
	case 'page':
		$controller = new C_Page();
		break;
	case 'auth':
		$controller = new C_Auth();
		break;
	case 'reg':
		$controller = new C_Reg();
		break;
    case 'product':
        $controller = new C_Products();
        break;
	case 'Photo_services':
		$controller = new C_Photo_services();
		break;
	case 'news':
		$controller = new C_News();
		break;
	case 'cart':
		$controller = new C_Cart();
		break;
	case 'order':
		$controller = new C_Order();
		break;
	default:
		$controller = new C_Page();
}

$controller->Request($action, $params);
