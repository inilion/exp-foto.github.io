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

            <input type = "text" name = "news_title" placeholder = "Название новости" >
            <input type = "text" name = "news_content" placeholder = "Описание новости" >




            <br>
            <input type = "submit" value = "Добавить фото" >
        </form >
    </div >
</div >
<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
var_dump($newss);
?>


<?php foreach ($newss as $item): ?>

    <div class="Box_service">


        <a href = "/index.php?c=Photo_services&act=oneService&id=<?php echo $item["news_id"]?>" >

            <h2 class="Box_service_title"><?php  echo $item ["news_title"]  ?></h2>

        </a>

        <div class="Box_service_img">

            <div  id="test<?php  echo $item ["news_id"]  ?>"></div >

            <style type="text/css">
                #test<?php    echo $item ["news_id"]  ?> {




                    height: 100%;
                }
                #test<?php    echo $item ["news_id"]  ?> img{
                    width: 100%;
                    height: 100%;
                }
            </style>

            <script type="text/javascript">
                $(function() {
                    $('#test<?php    echo $item ["news_id"]  ?>').crossSlide({
                        sleep: 2,
                        fade: 1
                    }, [
                        <?php foreach ($item["news_img"] as $ite): ?>

                        <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["news_foto_path"] ."'". '},' ?>

                        <?php endforeach; ?>
                    ]);
                });
            </script>




        </div>

        <div class="box_service_content">

            <div class="box_service_pay_in_content">
                <p> <?php echo $item  ["news_content"];?></p>
            </div>

            <div class="box_service_pay">
                <?php echo $item  ["news_pay"] . ':руб.';?>
            </div>

        </div>
    </div>
<?php endforeach; ?>
