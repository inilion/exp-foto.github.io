
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php  echo $title; ?></title>
    <link
        rel="stylesheet"
        href="/css/style.css"
        type="text/css"
        />
</head>
<body>
<h1 align="center"><?php  echo $title; ?></h1>

<?php include __DIR__ . '/box_menu.php';
// Кодировка.
header('Content-type: text/html; charset=utf-8');
?>

<div class="fileForChoise">
    <?php include __DIR__ . '/form.php'; ?>
</div>

<div class="galery">

    <?php echo $content; ?>





</div>

<footer>
    &copy MC
</footer>
</body>
</html>