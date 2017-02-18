<?php
/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>

<?php  if($_REQUEST['id']){

    echo '<div class="MSG">' . 'Теперь нужно добавить фотографии для продукта,
                             как минимум две штуки! Если нужна одна, тогда добавить
                                две одинаковые' . '</div>';
}
?>



    <div class="EditServiseTitle">
        <form  method = "post" enctype = "multipart/form-data" >
            <input type = "text" class = "TitleTypes" name = "Service_title" value="<?= htmlspecialchars($service ["service_title"]);?>" placeholder = "Название сервиса" >

    </div>


    <div class="EditServiceImg">
                <form  method = "post" enctype = "multipart/form-data" >

                    <?php foreach ($serviceFoto as $ite):
                    if($_REQUEST['id']) { ?>
                        <img src="<?php echo '/img_exp/' . $ite  ["service_foto_path"] ?>" style="max-width: 250px;">
                        <?php
                    }
                    endforeach; ?>

<br>
                    <input type = "file" class = "AllTypes" name = "Product_img" >
                    <input type = "submit" class = "AllTypes" value = "Отправить фотографию на сервер" >
    </div>

    <div class="EditServiceBOXContentPay">
                <form  method = "post" enctype = "multipart/form-data" >

                    <textarea rows="20" cols="20" name="Service_content"><?=htmlspecialchars($service  ["service_content"]); ?></textarea>
<br>
                    <input type = "number" class = "AllTypes" name = "Service_pay" value="<?=htmlspecialchars($service  ["service_pay"]);?>" placeholder = "Цена сервиса" >
                    <br>

                    <input type="submit" class = "AllTypes" value="Сохранить" />
                    <input class="AllTypes" type="submit" name="Delete" value="Удалить" />
                </form>
     </div>





<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
?>




    <?php foreach ($servicesWithFoto as $item): ?>

        <div class="Box_service">
            <a href="/Photo_services/editService&id=<?php echo $item ["service_id"] ?>">
                <h2 class="Box_service_title"><?php echo $item ["service_title"]; ?></h2>
            </a>


            <div class="Box_service_img">

                <div  id="test<?php  echo $item ["service_id"]  ?>"></div >

                <style type="text/css">
                    #test<?php    echo $item ["service_id"]  ?> {

                        height:100%;
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




