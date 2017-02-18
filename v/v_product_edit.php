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
            <input type = "text" class = "TitleTypes" name = "Product_title" value="<?= htmlspecialchars($product ["product_title"]);?>" placeholder = "Название продукта" >

        </div>


            <div class="EditServiceImg">


                    <?php foreach ($productFoto as $ite):
                        if($_REQUEST['id']) { ?>
                            <img src="<?php echo '/img_exp/' . $ite  ["product_foto_path"] ?>"
                                 style="max-width: 250px;">
                            <?php
                        }
                    endforeach; ?>

                    <br>
                    <input type = "file" class = "AllTypes" name = "Product_img" ><br><br>
                    <input type = "submit" class = "AllTypes" value = "Отправить фотографию на сервер" >

            </div>
    <div class="EditServiceBOXContentPay">





                    <p>Описание продукта: <textarea rows="20" cols="20" name="Product_content"><?=htmlspecialchars($product  ["product_content"]); ?></textarea></p>


        <p>Цена: <input type = "number" name = "Product_pay" value="<?=htmlspecialchars($product  ["product_pay"]);?>" placeholder = "Цена продукта" >руб.</p>

                    <input class="AllTypes" type="submit" value="Сохранить" />
                    <input class="AllTypes" type="submit" name="Delete" value="Удалить" />
            </form>

            </div>

        <?php //endforeach; ?>




<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}?>



<?php foreach ($productWithFoto as $item): ?>

    <div class="Box_ONE_Product">

        <div class="Box_ONE_Product_Title">
            <h2><?php echo $item  ["product_title"];?></h2>
        </div>

        <a href="/product/editProduct&id=<?php echo $item ["product_id"];?>">
            <div class="Box_ONE_Product_Img">

                <div  id="test<?php  echo $item ["product_id"]  ?>"></div ></div>
        </a>
        <style type="text/css">
            #test<?php echo $item["product_id"];?> {


                height: 100%;

            }
            #test<?php    echo $item ["product_id"]  ?> img{
                height: 100%;
                width: 100%;
            }
        </style>

        <script type="text/javascript">
            $(function() {
                $('#test<?php    echo $item ["product_id"]  ?>').crossSlide({
                    sleep: 2,
                    fade: 1
                }, [
                    <?php foreach ($item["product_img"] as $ite): ?>

                    <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["product_foto_path"] ."'". '},' ?>

                    <?php endforeach; ?>
                ]);
            });
        </script>




        <div class="Box_ONE_Product_Content">
            <?php echo $item  ["product_content"] ;?>
        </div>

        <div class="Box_ONE_IndexProduct_Pay">
            <div class="Box_ONE_IndexProduct_IN_Pay">
                <?php echo $item  ["product_pay"] . ':руб.';?>
            </div>

        </div>
    </div>

<?php endforeach; ?>


