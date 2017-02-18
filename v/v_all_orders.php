<?php if($can_use) {

}
//else{ echo '<div class="MSG">' . $message . '</div>'; };

var_dump($allOrders);

?>

         <?php   foreach($allOrders as $item):?>
             <div class="Box_Order">

                 <div class="Box_item_Id_Order"><?php echo $item["order_id"];?></div>
                 <div class="Box_item_Neame_User"><?php echo $item["name_user"];?></div>
                 <div class="Box_item_Mail_User"><?php echo $item["e_mail"];?></div>
                 <div class="Box_item_Phone_User"><?php echo $item["phone"];?></div>
                 <div class="Box_item_Addres_User"><?php echo $item["user_adr"];?></div>
                 <div class="Box_item"><?php echo $item["summ"];?></div>
             <?php   foreach($item["order_content"] as $key=>$ite):?>
                 <div class="Box_item"><?php echo $key;?></div>
                 <div class="Box_item"><?php echo $ite["price"];?></div>
                 <div class="Box_item"><?php echo $ite["count"];?></div>
             <?php endforeach;?>

                 <div class="Box_item_Date_Order"><?php echo $item["date_order"];?></div>

             </div>



         <?php  endforeach;?>

