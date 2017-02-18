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

        <input type = "text" name = "Product_title" placeholder = "Название продукта" ><br>
        <input type = "text" name = "Product_content" placeholder = "Описание продукта" ><br>
        <input type = "text" name = "Product_pay" placeholder = "Цена продукта" > <br >




        <input type = "submit" value = "Добавить продукт" >

    </form >
</div >
</div >
<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
?>




    <?php foreach ($productWithFoto as $item): ?>
        <div class="Box_ONE_Product">
            <div class="Box_ONE_Product_Title">
                <h2><?php echo $item  ["product_title"];?></h2>
            </div>

            <a href="/product/oneProduct&id=<?php echo $item ["product_id"] ?>"/>
            <div class="Box_ONE_Product_Img">

                <div  id="test<?php  echo $item ["product_id"]  ?>"></div >
</a>
                <style type="text/css">
                    #test<?php    echo $item ["product_id"]  ?> {

                        border: 2px solid #f9f9f9;
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

            </div>


            <div class="Box_ONE_Product_Content">
                <?php echo $item  ["product_content"] ;?>
            </div>

            <div class="Box_ONE_Product_Pay">
                <div class="Box_ONE_Product_IN_Pay">
                    <?php echo $item  ["product_pay"] . ':руб.';?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>



