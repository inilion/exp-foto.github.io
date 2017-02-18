

    <?php foreach ($itemsmp3 as $itemmp3): ?>
        <div class="Box_For_Alboms_galery scalemin">
            <div class="Box_For_Alboms_ispolnitel scalemax">
                <p><?php echo $itemmp3['titleSinger']; ?></p>
            </div>


            <div class="Box_For_Alboms_Foto">
                <?php
                $ite = $itemmp3['Photo_Albom'];
                $itemfoto = explode('///////', "$ite");
                ?>
                <?php foreach ($itemfoto as $velue): ?>

                <?php endforeach; ?>
                <div class="Box_For_Alboms_Foto_albom_value ">
                    <img src="<?php echo '/unzip/' .  $itemmp3['titleSinger'] . '/' . $itemmp3['titleAlbom'] . '/' . $velue; ?>" >
                </div>
            </div>
            <div class="Box_For_Alboms_ispolnitel_Alboms">
                <p><?php echo $itemmp3['titleAlbom']; ?></p>
            </div>
        </div>


    <?php endforeach; ?>
