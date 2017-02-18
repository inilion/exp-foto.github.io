<?php


?>






<div class="Box_Product_ONE" >


    <?php// foreach ($productFoto as $item): ?>
    <div class="Box_ONE_Product_ONE">
        <div class="Box_ONE_Product_Title_ONE">
            <h2><?php echo $services  ["service_title"];?></h2>
        </div>

        <a href="/index.php?c=product&act=oneProduct&id=<?php echo $services ["service_id"] ?>">
            <div class="Box_ONE_Product_Img_ONE">

                <div  id="test<?php  echo $services ["service_id"]  ?>"></div >
        </a>
        <style type="text/css">
            #test<?php    echo $services ["service_id"]  ?> {


                width:100%;
                height: 100%;
            }
            #test<?php    echo $services ["service_id"]  ?> img{
                height: 100%;
                width: 100%;
            }
        </style>

        <script type="text/javascript">
            $(function() {
                $('#test<?php    echo $services ["service_id"]  ?>').crossSlide({
                    sleep: 2,
                    fade: 1
                }, [
                    <?php foreach ($servicesFoto as $ite): ?>

                    <?php echo '{ src:' . "'" .'/img_exp/' . $ite  ["service_foto_path"] ."'". '},' ?>

                    <?php endforeach; ?>
                ]);
            });
        </script>

    </div>


    <div class="Box_ONE_Product_Content_ONE">
        <?php echo $services["service_content"] ;?>
    </div>

    <div class="Box_ONE_Product_Pay_ONE">
        <div class="Box_ONE_Product_IN_Pay_ONE">
            <?php echo $services  ["service_pay"] . ':руб.';?>
        </div>
    </div>
</div>
<?php// endforeach; ?>

</div>

