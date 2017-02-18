<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>InIlion dub Radio</title>
    <link
        rel="stylesheet"
        href="../css/style.css"
        type="text/css"
        />
</head>
<body>
<h1 align="center">InIlion dub Radio</h1>
<ul>
    <li><a href="../index.php">Главная</a></li>
    <li><a href="статьи.html">Статьи</a></li>
    <li><a href="каталог.html">Каталог</a></li>
    <li><a href="../galary.php">Галерея изображений</a></li>
    <li><a href="регистрация.html">Регистрация</a></li>
    <li><a href="контакты.html">Контакты</a></li>
</ul>
<div class="fileForChoise">
    <?php include __DIR__ . '/form_for_music.php'; ?>

</div>
<div>
<?php include __DIR__ . '/form_for_alboms.php'; ?>
</div>
<div class="galery">


    <table border="1">
        <tr>
            <th>Название</th>
            <th>Music</th>
        </tr>
        <?php foreach ($itemsmp3 as $itemmp3): ?>
            <tr>
                <td><p><?php echo $itemmp3['title']; ?></p></td>
                <td>
                        <audio controls>
                            <source src="<?php echo $itemmp3['path']; ?>" type="audio/ogg; codecs=vorbis"  controls="controls">
                            <source src="<?php echo $itemmp3['path']; ?>" type="audio/mpeg">

                            <a href="<?php echo $itemmp3['path']; ?>">Скачайте музыку</a>.
                        </audio>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>



</div>
<footer>
    &copy MC
</footer>
</body>
</html>