<?php
/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>

<div class="Form_for_add" >
    <div class="Form_for_add_title_contentent_pay" >
    <form  method = "post" enctype = "multipart/form-data" >

        <input type = "text" name = "Service_title" placeholder = "Название сервиса" >
        <input type = "text" name = "Service_content" placeholder = "Описание сервиса" >
        <input type = "text" name = "Service_pay" placeholder = "Цена сервиса" > <br >



        <br>
        <input type = "submit" value = "Добавить сервис" >
    </form >
</div >
</div >
<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
?>


<?php foreach ($services as $item): ?>

<div class="Box_service">


    <a href = "/index.php?c=Photo_services&act=oneService&id=<?php echo $item["service_id"]?>" >

        <h2 class="Box_service_title"><?php  echo $item ["service_title"]  ?></h2>

    </a>

    <div class="Box_service_img">

        <div  id="test<?php  echo $item ["service_id"]  ?>"></div >

        <style type="text/css">
            #test<?php    echo $item ["service_id"]  ?> {
                border: 2px solid #f9f9f9;



                height: 100%;
            }
            #test<?php    echo $item ["service_id"]  ?> img{
                width: 100%;
                height: 100%;
            }
        </style>

        <script type="text/javascript">
            $(function() {
                $('#test<?php    echo $item ["service_id"]  ?>').crossSlide({
                    sleep: 2,
                    fade: 1
                }, [
                    <?php foreach ($item["service_img"] as $ite): ?>

                    <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["service_foto_path"] ."'". '},' ?>

                    <?php endforeach; ?>
                ]);
            });
        </script>




    </div>

    <div class="box_service_content">

        <div class="box_service_pay_in_content">
            <p> <?php echo $item  ["service_content"];?></p>
        </div>

        <div class="box_service_pay">
            <?php echo $item  ["service_pay"] . ':руб.';?>
        </div>

    </div>
</div>
<?php endforeach; ?>

<div class="Box_first">
    <?=nl2br($text)?>
</div>