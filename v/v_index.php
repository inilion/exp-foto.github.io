<?php
/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>

<?php

?>

<div class="Img_Photo">

</div>
<a href="#up">
    <div class="Img_Photo_Round">

    </div>

<script type="text/javascript">
    $(document).ready(function() {
        $("body").css("display", "none");

        $("body").fadeIn(1000);

        $("a.transition").click(function(event){
            event.preventDefault();
            linkLocation = this.href;
            $("body").fadeOut(1000, redirectPage);
        });

        function redirectPage() {
            window.location = linkLocation;
        }
    });
</script>

<script type="text/javascript">
    $(function() {
        $('#test1').crossSlide({
            sleep: 2,

            fade: 1
        }, [

            <?php foreach ($product as $ite): ?>

            <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["product_img"] ."'". '},' ?>

            <?php endforeach; ?>

        ]);

    });

</script>

    <?php// if ($user != null): ?>

        <?php// echo 'Логин:' . ' ' . $user['login']?>

    <?php// endif ?>




        <?php// var_dump($news); ?>
        <?php// echo'<br>'; ?>
        <?php// var_dump($_COOKIE); ?>





    <div class="Mane_For_Scroll">
        <a href="/Photo_services/index"><div class="Mane_For_Scroll_LI"><p>Услуги:</p></div></a>

            <?php
            foreach($servicesFoto as $val):
                echo '<a href="#ser' . $val["service_id"] . '"><div class="Mane_For_Scroll_LI">' . $val["service_title"] . '</div></a>';
                ?>

            <?php endforeach; ?>

    </div>












<div class="Mane_For_Scroll">
    <ul>
        <?php
        foreach($news as $val):
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



<?php foreach ($news as $item): ?>

    <div class="Box_service">


        <h2 class="Box_service_title" id="<?php echo 'ser' . $item["news_id"] ?>"><?php  echo $item ["news_title"]  ?></h2>


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






















    <?php foreach ($servicesFoto as $item): ?>

        <div class="Box_service">


            <h2 class="Box_service_title" id="<?php echo 'ser' . $item["service_id"] ?>"><?php  echo $item ["service_title"]  ?></h2>


            <div class="Box_service_img">
                <a href = "/Photo_services/oneService&id=<?php echo $item["service_id"]?>" >
                    <div  id="test<?php  echo $item ["service_id"]  ?>"></div >
                </a>
                <style type="text/css">
                    #test<?php    echo $item ["service_id"]  ?> {



                        width: 100%;
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
                    <p> <?php echo $item  ["service_content"];?></p>
                </div>

                <div class="box_service_pay">
                    <?php echo 'От ' . $item  ["service_pay"] . ':руб.';?>
                </div>

            </div>

        </div>
    <?php endforeach; ?>







<div class="UnderAlLFoto"><img src="/img_exp/background_vector.png"></div>
    <?php
/*
 *
 * <script type="text/javascript">
    $(function() {
        $('#test1').crossSlide({
            sleep: 2,

            fade: 1
        }, [

            <?php foreach ($services as $item): ?>
            <?php foreach ($item["service_img"] as $ite): ?>

            <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["service_foto_path"] ."'". '},' ?>

            <?php endforeach; ?>
            <?php endforeach; ?>

        ]);

    });
</script>
 *
 *
 *
 *
 */


?>
