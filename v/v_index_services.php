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
            foreach($services as $val):
        echo '<li><a href="#ser' . $val["service_id"] . '">' . $val["service_title"] . '</a></li>';
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



    <?php foreach ($services as $item): ?>

<div class="Box_service">


               <h2 class="Box_service_title" id="<?php echo 'ser' . $item["service_id"] ?>"><?php  echo $item ["service_title"]  ?></h2>


         <div class="Box_service_img">
             <a href = "/Photo_services/oneService&id=<?php echo $item["service_id"]?>" >
             <div  id="test<?php  echo $item ["service_id"]  ?>"></div >
             </a>
                       <style type="text/css">
                       #test<?php    echo $item ["service_id"]  ?> {



                            width: 100%;
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
                       <?php echo $item  ["service_pay"] . ':руб.';?>
                </div>

           </div>
</div>
        <?php endforeach; ?>




