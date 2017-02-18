
<?php

include_once('functions/view.php');
require __DIR__ . '/models/photo.php';
// Массив со статьёй
$title = 'фото';
$items = Photo_getAll();
$f = [];
foreach ($items as $ite){
    $f = $ite;
}

// Внутренний шаблон.
$content = view_include(
    'views/v_galary.php',
     array('foto' => $items));

// Внешний шаблон.
$page = view_include(
    'views/galary.php',
    array('title' => $title, 'content' => $content));



// Вывод.
echo $page;


//include __DIR__ . '/views/galary.php';
?>