<?php

/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>

    <div class="Mane_For_Scroll">
        <ul>
            <?php
            foreach($newss as $val):
                echo '<li><a href="#ser' . $val["news_id"] . '">' . $val["news_title"] . '</a></li>';
                ?>

            <?php endforeach; ?>
        </ul>
    </div>

<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
?>



<?php foreach ($newss as $item): ?>

    <div class="Box_service">

    <div class="Box_news_title" id="<?php echo 'ser' . $item["news_id"] ?>">

        <div class="Foto_for_title_news">
            <img src="/img_exp/PhotoIcon1.png">
        </div>

        <div class="Foto_for_title_news_flash">
            <img src="/img_exp/Flash.png">
        </div>

            <h2 class="H2_title_news">
                 <?php  echo $item ["news_title"]  ?>
            </h2>

        <div class="Foto_for_title_news_2">
            <img src="/img_exp/PhotoIconInver1.png">
        </div>

        <div class="Foto_for_title_news_flash2">
            <img src="/img_exp/Flash2.png">
        </div>

    </div>

        <div class="Box_service_img">

                <div  id="test<?php  echo $item ["news_id"]  ?>"></div >

            <style type="text/css">
                #test<?php    echo $item ["news_id"]  ?> {



                    width: 100%;
                    height:100%;
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

            <script type="text/javascript">
                $('a[href^="#"]').bind('click.smoothscroll',function (e) {
                    e.preventDefault();

                    var target = this.hash,
                        $target = $(target);

                    $('html, body').stop().animate({
                        'scrollTop': $target.offset().top
                    }, 500, 'swing', function () {
                        window.location.hash = target;
                    });
                });
            </script>


        </div>

        <div class="box_service_content">

            <div class="box_service_pay_in_content">
                <p> <?php echo $item  ["news_content"];?></p>
            </div>



        </div>
    </div>
<?php endforeach; ?>