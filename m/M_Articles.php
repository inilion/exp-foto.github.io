<?php


class M_Articles
{
private static $instance; // ссылка на экземпляр класса
private  $conn; // ссылка на экземпляр класса

//
// Получение единственного экземпляра (одиночка).
//
public static function Instance()
{
if (self::$instance == null)
self::$instance = new M_Articles();

return self::$instance;

}

private function __construct(){

    $conn =mysql_query("SET character_set_results = 'utf8',
                character_set_client = 'utf8',
                character_set_connection = 'utf8',
                character_set_database = 'utf8',
                character_set_server = 'utf8'");

    return $conn;
}

function articles_all()
{
// Запрос.
$query = "SELECT * FROM products ORDER BY product_id DESC";
$result = mysql_query($query);

if (!$result)
die(mysql_error());

// Извлечение из БД.
$n = mysql_num_rows($result);
$articles = array();

for ($i = 0; $i < $n; $i++)
{
$row = mysql_fetch_assoc($result);
$articles[] = $row;
}

return $articles;
}

//
// Конкретная статья
//
public function product_get($product_id)
{
// Запрос.
    $query = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = mysql_query($query);
//var_dump($result);
  //  die;
        if (!$result)
        die(mysql_error());

    $article = mysql_fetch_assoc($result);

return $article;
}


//
// Добавить статью
//
function articles_new($product_title, $product_content, $product_pay)
{
// Подготовка.
$product_title = trim($product_title);
$product_content = trim($product_content);
$product_pay = trim($product_pay);


// Проверка.
if ($product_title == '')
return false;

// Запрос.
$t = "INSERT INTO products (product_title, product_content, product_pay) VALUES ('%s', '%s', '%s')";

$query = sprintf($t,
mysql_real_escape_string($product_title),
mysql_real_escape_string($product_content),
mysql_real_escape_string($product_pay));

$result = mysql_query($query);

if (!$result)
die(mysql_error());

    return mysql_insert_id();
}


    function newProductFoto($product_id, $product_foto_title, $product_foto_path){

        $product_id = trim($product_id);
        $product_foto_title = trim($product_foto_title);
        $product_foto_path = trim($product_foto_path);

        $t = "INSERT INTO products_foto (product_id, product_foto_title, product_foto_path)   VALUES ('%s', '%s', '%s')";

        $query = sprintf($t,
            mysql_real_escape_string($product_id),
            mysql_real_escape_string($product_foto_title),
            mysql_real_escape_string($product_foto_path));


        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }




//
// Изменить статью
//
function product_edit($product_id, $product_title, $product_content, $product_pay)
{
// Подготовка.
    $product_id=trim($product_id);
    $product_title = trim($product_title);
    $product_content = trim($product_content);
    $product_pay = trim($product_pay);

// Проверка.
if ($product_title == '')
return false;

// Запрос.
$t = "UPDATE products SET product_title='%s', product_content='%s', product_pay='%s' WHERE product_id='$product_id'";

$query = sprintf($t,
mysql_real_escape_string($product_title),
mysql_real_escape_string($product_content),
mysql_real_escape_string($product_pay));

$result = mysql_query($query);

if (!$result)
die(mysql_error());

return true;
}




    // Конкретная сервис с фотографиями
//
    public function product_get_ALL_Photo($product_id)
    {
// Запрос.
        $query = "SELECT product_foto_path FROM  products_foto WHERE product_id ='$product_id'";
//var_dump($service_id);
        //       die;
        //    "SELECT * FROM services_foto WHERE service_id ='$service_id'";
        $result = mysql_query($query);
//var_dump($result);
        //    die;
        if (!$result)
            die(mysql_error());
// Извлечение из БД.
        $n = mysql_num_rows($result);
        // var_dump($n);
        // die;
        $productFoto = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $productFoto[] = $row;
        }

        // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
        // die;
        return $productFoto;
    }

    function getProductPrice($id)
    {
        $sql = "SELECT product_pay FROM products WHERE product_id='$id'";
        $result = mysql_query($sql)  or die(mysql_error());

        if($row = mysql_fetch_object($result))
        {
            return $row;
        }
        return false;
    }








//
// Удалить статью
//
function product_delete($id)
{
// Запрос.
$query = "DELETE FROM products WHERE product_id='$id'";

$result = mysql_query($query);

if (!$result)
die(mysql_error());

return true;
}

    function product_foto_delete($id)
    {
// Запрос.
        $query = "DELETE FROM products_foto WHERE product_id='$id'";

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }

//
// Короткое описание статьи
//
function articles_intro($article)
{
if(strlen($article)>120)
{
$article = substr($article,0,120)."...";
}

return $article;

}


}