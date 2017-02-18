<?php
/**
 * Шаблон главной страницы
 * =======================
 * $text - текст
 */
?>
<div class="Box_first">

    <?php var_dump($_POST); ?>
</div>

<?php //var_dump($_GET['act']);
//if ($_GET['act'] = 'newProduct') {
//  echo
// include_once  '/views/Box_Add_New_Product';
//}
?>

<div class="Box_first" >
    <form  method = "post" enctype = "multipart/form-data" >

        <input type = "text" name = "Product_title" placeholder = "Название продукта" >
        <input type = "text" name = "Product_content" placeholder = "Описание продукта" >
        <input type = "text" name = "Product_pay" placeholder = "Цена продукта" > <br >
        <label for="image" > Фотография продукта </label >
        <input type = "file" id = "image" name = "Product_img" > <br >


        <input type = "submit" value = "Добавить продукт" >

    </form >
</div >

<div class="Box_first">


    <table border = "2px" class="Table_product">
        <tr>
            <th>foto</th>
            <th>name</th>
            <th>Opisanie</th>
            <th>Cena</th>

        </tr>

        <?php// foreach ($articles as $item): ?>
        <tr>

            <td>
                <a href="<?php echo '/img_exp/' . $articles  ["product_img"] ?>" >
                    <img src="<?php echo '/img_exp/' . $articles  ["product_img"] ?>" style="max-width: 350px;"
            </td>
            <td><?php echo '<input type = "text" name = "Product_title"
                                placeholder = "Название продукта" value="'?> <?php echo $articles  ["product_content"] . '"'; ?> ></td>
            <td><?php echo $articles  ["product_content"] ;  ?></td>
            <td><?php echo $articles  ["product_pay"] . ':руб.' ;  ?></td>
        </tr>
        <?php //endforeach; ?>

    </table>


</div>


