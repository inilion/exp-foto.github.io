<?php
/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>


    <?php// var_dump($products); ?>


<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
  //  echo
  // include_once  '/views/Box_Add_New_Product';
//}
?>







    <?php foreach ($products as $item): ?>

    <div class="Box_ONE_Product">

            <div class="Box_ONE_Product_Title">
                <h2><?php echo $item  ["product_title"];?></h2>
            </div>

                 <a href="/product/oneProduct&id=<?php echo $item ["product_id"] ?>">
                        <div class="Box_ONE_Product_Img">

                         <div  id="test<?php  echo $item ["product_id"]  ?>"></div ></div>
            </a>
                <style type="text/css">
                    #test<?php    echo $item ["product_id"]  ?> {


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
            <b>&nbsp;<?php echo $item  ["product_content"] ;?></b>
        </div>

        <div class="Box_ONE_IndexProduct_Pay">
        <div class="Box_ONE_IndexProduct_IN_Pay">
            <?php echo $item  ["product_pay"] . ':руб.';?>
        </div>

        </div>
        <a href="/cart/AddIteem/<?php echo $item ["product_id"]; ?>">
            <div class="Box_Product_By">
                <p>Купить</p>
            </div></a>
        </div>

    <?php endforeach; ?>







