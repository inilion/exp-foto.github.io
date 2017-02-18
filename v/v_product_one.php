
        <?php
             if($_SESSION['MSG']) {
                echo '<div class="MSG"><b>' . $_SESSION['MSG'] . '</b>
                        . <a href="/cart/index"><p>Перейти в корзину>>></p></a></div>';
                unset ($_SESSION['MSG']);
                }
        ?>


    <div class="Box_Product_ONE" >



            <div class="Box_ONE_Product_ONE">

                <div class="Box_ONE_Product_Title_ONE">
                    <h2><?php echo $articles  ["product_title"];?></h2>
                </div>






                <div class="Box_ONE_Product_Img_ONE">


                    <div  id="test<?php  echo $articles ["product_id"]  ?>"></div >





                    <style type="text/css">
                        #test<?php echo $articles ["product_id"]  ?> {


                            width: 100%;
                            height: 100%;
                        }
                        #test<?php    echo $articles ["product_id"]  ?> img{
                            height: 100%;
                            width: 100%;
                        }
                    </style>

                    <script type="text/javascript">
                        $(function() {
                            $('#test<?php    echo $articles ["product_id"]  ?>').crossSlide({
                                sleep: 2,
                                fade: 1
                            }, [
                                <?php foreach ($productFoto as $ite): ?>

                                <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["product_foto_path"] ."'". '},' ?>

                                <?php endforeach; ?>
                            ]);
                        });
                    </script>
                </div>

                <div class="Box_ONE_Product_Content_ONE">
                    <?php echo $articles["product_content"] ;?>
                </div>

                <div class="Box_ONE_Product_Pay_ONE">

                    <div class="Box_ONE_Product_IN_Pay_ONE">
                        <?php echo  $articles  ["product_pay"] . ':руб.';?>
                    </div>


                </div>
                </div>

        <a href="/cart/AddIteem/<?php echo $_GET["id"]; ?>">
            <div class="Box_ONE_Product_IN_Pay">
                <p>Купить</p>
            </div></a>


            </div>


