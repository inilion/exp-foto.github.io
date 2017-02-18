<?php
session_start();

?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>InIlion dub Radio</title>
    <link
        rel="stylesheet"
        href="../css/style.css"
        type="text/css"
        />
</head>
<body>
<h1 align="center">InILion dub Radio</h1>

<?php include __DIR__ . '/box_menu.php'; ?>

<div class="Mesage_Error">
    <?php echo $_SESSION['error'];
            unset ($_SESSION['error']);
    ?>
</div>
<div class="Form_reg">
<form action="/add_user.php" method="post" enctype="multipart/form-data">

    <fieldset>
        <legend>Ваше имя: *</legend>
        <input type="text" name="Firstname" value="" size="30" placeholder="Обязателно к заполнению"/>
    </fieldset>

    <fieldset>
        <legend>Выберите фотографию </legend>
        <input type="file" accept="*/*"  name="Foto"/>
    </fieldset>

    <fieldset>
        <legend>Адрес вашей электронной почты *</legend>
        <input type="email" name="Mail" value="" size="30" placeholder="Обязателно к заполнению"/>
    </fieldset>

    <fieldset>
        <legend>Логин *</legend>
        <input  type="text" name="Login" value="" size="20" placeholder="Обязателно к заполнению"/>
    </fieldset>

    <fieldset>
        <legend>Пароль *</legend>
        <input  type="password" name="Pass" size="20" placeholder="Обязателно к заполнению"/>
    </fieldset>

    <fieldset>
        <legend>Введите пароль повторно *</legend>
        <input type="password" name="DublePass" size="20" placeholder="Обязателно к заполнению"/>
    </fieldset>

    <fieldset>
        <legend>Выберите пол *</legend>
        <p><input type="radio" name="Gender" value="М">Мужской
            <input type="radio" name="Gender" value="Ж">Женский
        </p>
    </fieldset>

    <fieldset>
        <legend>Выберите дату рождения *</legend>
        <input  type="date" name="Date" />
    </fieldset>

    <fieldset>
        <legend>Каким браузером предпочитаете пользоваться</legend>
        <p>
            <input type="checkbox" name="option1" value="a1"/>Opera<br>
            <input type="checkbox" name="option2" value="a2"/>Internet Explorer<br>
            <input type="checkbox" name="option3" value="a3"/>Mozila Firefox<br>
            <input type="checkbox" name="option4" value="a4"/>Google Chrome<br>
            <input type="checkbox" name="option5" value="a5"/>Safari<br>
        </p>
    </fieldset>
    <fieldset>
        <legend>Дополнительная информация</legend>
				     <textarea name="Aboutself" cols="50" rows="5" value="<?php echo $_SESSION['Aboutself']; ?> ">
			         </textarea>
    </fieldset>
    <br><br>
    <input type="submit" name="submit" value="Зарегистрироваться">
    <input type="reset" value="Отмена">
    <br><br>
</form>
    </div>

<footer>
    &copy MC
</footer>
</body>
</html>
<?php


?>