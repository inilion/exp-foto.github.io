
                                <h2>Регистрация</h2>


                                <?php
                                if($_SESSION['error']) {
                                    echo '<div class="MSG"><p>' . $_SESSION['error'] . '</p></div>';
                                    unset ($_SESSION['error']);
                                }
                                ?>


<div class="Form_reg">
    <form action="/reg/reg" method="post" enctype="multipart/form-data">

        <fieldset>
            <legend class="Form_reg_Legend">Ваше имя: *</legend>
           <div class="Form_reg_Input"><input class="type_for_reg" type="text" name="Firstname" value="" size="30" placeholder="Обязателно к заполнению"/></div>
        </fieldset>

        <fieldset>
            <legend class="Form_reg_Legend">Адрес вашей электронной почты *</legend>
            <div class="Form_reg_Input"><input class="type_for_reg" type="email" name="Mail" value="" size="30" placeholder="Обязателно к заполнению"/></div>
        </fieldset>

        <fieldset>
            <legend class="Form_reg_Legend">Пароль *</legend>
            <div class="Form_reg_Input"><input class="type_for_reg" type="password" name="Pass" size="30" placeholder="Обязателно к заполнению"/></div>
        </fieldset>

        <fieldset>
            <legend class="Form_reg_Legend">Введите пароль повторно *</legend>
            <div class="Form_reg_Input"><input class="type_for_reg" type="password" name="DublePass" size="30" placeholder="Обязателно к заполнению"/></div>
        </fieldset>


        <br><br>
        <input class="type_for_Zareg" type="submit" name="submit" value="Зарегистрироваться">
        <input class="type_for_Zareg" type="reset" value="Отмена">
        <br><br>
    </form>
</div>