<?php


function text_get()
{
	return file_get_contents('data/text.txt');
}

function text_set($text)
{
	file_put_contents('data/text.txt', $text);
}



function products_all()
{
    //Запрос
    $conn = startUup();
    $result = $conn->query("SELECT * FROM products ORDER BY id_produ DESC ");
    if (!$result)
        die;($conn->error);
}
function GetFilesList()
{
    $FileList = [];
    $scanning_files_list = scandir ('img_exp/suvenir');
    foreach($scanning_files_list as $value) {
        if (($value == '.') || ($value == '..')) {
            continue;

        } else {
            $FileList[] = $value;
        }
    }
    return $FileList;
}

function checkLoginPassword($login, $password)
{
    $users = ['5c18188325b1bc0e708c09086e5394c3' => '202cb962ac59075b964b07152d234b70', 'ivanov' => 'qwerty'];

    return isset($users[$login]) && $password == $users[$login];

}

function login($login){
    setcookie('auth', $login, time()+86400);
}

function isUser ()
{
    return isset($_COOKIE['auth']);
}

function logout()
{
    unset($_COOKIE['auth']);
    setcookie('auth', '', time()-86400);
}