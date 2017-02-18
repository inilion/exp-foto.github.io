<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>InIlion dub Radio</title>
    <link
        rel="stylesheet"
        href="/css/style.css"
        type="text/css"
        />
</head>
<body>

    <div class="Zag_H1">
            <h1 align="center">InILion dub Radio</h1>
    </div>

<?php include __DIR__ . '/box_menu.php'; ?>

<div class="Buttom_for_file_insert">

    <div class="registration_form">


        <form action="/models/music_select.php" method="post" enctype="multipart/form-data">
            <input type="submit" name="sub" value="New albom">
        </form>

        <?php var_dump($_SESSION);
        ?>
    </div>

</div>

<div class="fileForChoise">
    <?php include __DIR__ . '/form_for_alboms.php'; ?>
</div>



<div class="Box_For_Alboms ">
    <a href="form.php"><?php include __DIR__ . '/box_all_alboms.php'; ?></a>
</div>



<div class="Box_Pleer">

    <?php foreach ($itemsmp3 as $itemmp3): ?>
        <div class="galery">
    <div class="ispolnitel">
        <p>Исполнитель: <?php echo $itemmp3['titleSinger']; ?></p>
    </div>

        <div class="albom">
            <p>Альбом: <?php echo $itemmp3['titleAlbom']; ?></p>
        </div>
        <div class="Foto_albom">
             <?php
             $ite = $itemmp3['Photo_Albom'];
                $itemfoto = explode('///////', "$ite");
                ?>
    <?php foreach ($itemfoto as $velue): ?>


        <div class="Foto_albom_value">
                    <img src="<?php echo '/unzip/' .  $itemmp3['titleSinger'] . '/' . $itemmp3['titleAlbom'] . '/' . $velue; ?>" >

            <source src="<?php echo '/unzip/' .  $itemmp3['titleSinger'] . '/' . $itemmp3['titleAlbom'] . '/' . $velue; ?> " type=""  >

        </div>


    <?php endforeach; ?>
</div>

    <div class="tracks">





                <div class="Traks_Name_Singer"><p><?php echo $itemmp3['titleSinger']; ?></p></div>
                <div class="Traks_Name_Albom"><p><?php echo $itemmp3['titleAlbom']; ?></p></div>


                    <?php
                     $ite = $itemmp3['Traks'];
                    $itemTrecks = explode('///////', "$ite");
                 //   var_dump( $ite);
                 //  die;
                    ?>
                    <?php foreach ($itemTrecks as $velue): ?>
                      <div class="Track_Name"><?php echo $velue; ?></div>
                    <audio controls="controls" preload="none" loop="loop">

                        <source src="<?php echo '/unzip/' .  $itemmp3['titleSinger'] . '/' . $itemmp3['titleAlbom'] . '/' . $velue; ?> " type="audio/ogg; codecs=vorbis"  controls="controls">
                        <source src="<?php echo '/unzip/' .  $itemmp3['titleSinger'] . '/' . $itemmp3['titleAlbom'] . '/' . $velue; ?>" type="audio/mpeg">

                        <a href="<?php echo $velue; ?>">Скачайте музыку</a>.
                    </audio>
                <?php endforeach; ?>
                </div>


    </div>

    <?php endforeach;
//   var_dump($itemmp3);
//    die;
    ?>
</div>

<div class="footer">
<footer>
    &copy MC
</footer>
</div>

</body>
</html>