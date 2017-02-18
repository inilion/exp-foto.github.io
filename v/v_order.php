<h2>Оформление заказа</h2>
<a href="/cart/index"><<< Назад в корзину</a>
<br/>

<?
echo $dislpay_form;
if($dislpay_form){?>
    <div class="Form_reg">
        <form action="" method="post" enctype="multipart/form-data">

            <fieldset>
                <legend class="Form_reg_Legend">Ф.И.О. *</legend>
                <div class="Form_reg_Input"><input class="type_for_reg" type="text" name="fio" value="" size="30" placeholder="Обязателно к заполнению"/></div>
            </fieldset>

            <fieldset>
                <legend class="Form_reg_Legend">E-mail *</legend>
                <div class="Form_reg_Input"><input class="type_for_reg" type="email" name="email" value="" size="30" placeholder="Обязателно к заполнению"/></div>
            </fieldset>

            <fieldset>
                <legend class="Form_reg_Legend">Телефон *</legend>
                <div class="Form_reg_Input"><input class="type_for_reg" type="number" name="phone" value="" size="30" placeholder="Обязателно к заполнению"/></div>
            </fieldset>

            <fieldset>
                <legend class="Form_reg_Legend">Адрес *</legend>
                <div class="Form_reg_Input"><textarea name="adres">г.Самара</textarea></div>
            </fieldset>



            <br><br>
            <input class="type_for_Zareg" type="submit" name="order" value="Оформить заказ">

        </form>
    </div>
<?}

else{ echo '<div class="MSG">' . $message . '</div>'; };

?>


