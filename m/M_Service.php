<?php


class M_Service
{
    private static $instance; // ссылка на экземпляр класса
    private  $conn; // ссылка на экземпляр класса

//
// Получение единственного экземпляра (одиночка).
//
    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new M_Service();

        return self::$instance;

    }

    private function __construct(){
        $conn =  mysql_connect('localhost', 'root', '1234');
        $conn =mysql_select_db('expert');
        $conn =mysql_query("SET character_set_results = 'utf8',
                character_set_client = 'utf8',
                character_set_connection = 'utf8',
                character_set_database = 'utf8',
                character_set_server = 'utf8'");

        return $conn;
    }

    function service_all()
    {
// Запрос.
        $query = "SELECT * FROM services ORDER BY service_id DESC";
        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

// Извлечение из БД.
        $n = mysql_num_rows($result);
        $service = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $service[] = $row;
        }
//var_dump($services);
//        die;
        return $service;
    }

//
// Конкретная статья
//
    public function service_get($service_id)
    {
// Запрос.
        $query = "SELECT * FROM services WHERE service_id='$service_id'";
        $result = mysql_query($query);
//var_dump($result);
        //  die;
        if (!$result)
            die(mysql_error());

        $service = mysql_fetch_assoc($result);

        return $service;
    }


// Конкретная сервис с фотографиями
//
    public function service_get_Photo()
    {
// Запрос.
        $query = "SELECT * FROM services_foto WHERE service_id";
        $result = mysql_query($query);
//var_dump($result);
     //    die;
        if (!$result)
            die(mysql_error());
// Извлечение из БД.
        $n = mysql_num_rows($result);
        $serviceFoto = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $serviceFoto[] = $row;
        }

       // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
       // die;
        return $serviceFoto;
    }


    // Конкретная сервис с фотографиями
//
    public function service_get_ALL_Photo($service_id)
    {
// Запрос.
        $query = "SELECT service_foto_path FROM  services_foto WHERE service_id ='$service_id'";
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
        $serviceFoto = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $serviceFoto[] = $row;
        }

        // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
        // die;
        return $serviceFoto;
    }

//
// Добавить статью
//
    function service_new($service_title, $service_content, $service_pay)
    {
// Подготовка.
        $service_title = trim($service_title);
        $service_content = trim($service_content);
        $service_pay = trim($service_pay);
       // $service_img = trim($service_img);
        ////foto//
     //   $service_foto_title = trim($service_foto_title);
     //   $service_foto_path = trim($service_foto_path);

 //var_dump($service_img);
       // die;
// Проверка.
        if ($service_title == '')
            return false;

//  добавление фотографий в  "services_foto".

//        $t = "INSERT INTO services_foto (foto_id, service_foto_title, service_foto_path) VALUES ('%s' = service_id, '%s', '%s')";
//        $t = "SELECT service_id, service_foto_title, service_foto_path  FROM services, products WHERE service_id = product_id";
//        $query = sprintf($t);
//        $result = mysql_query($query);
//      //  Извлечение из БД.
//    $n = mysql_num_rows($result);
//        $service_id = array();
//
//        for ($i = 0; $i < $n; $i++)
//        {
//            $row = mysql_fetch_assoc($result);
//            $service_id[] = $row;
//        }


//        var_dump($service_id);
 //       die;
// Запрос.
        $t = "INSERT INTO services (service_title, service_content, service_pay )   VALUES ('%s', '%s', '%s')";

        $query = sprintf($t,
            mysql_real_escape_string($service_title),
            mysql_real_escape_string($service_content),
            mysql_real_escape_string($service_pay));

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

     //   return true;


        return mysql_insert_id();
    }

//
// Изменить статью
//
    function service_edit($service_id, $service_title, $service_content, $service_pay)
    {
// Подготовка.
        $service_id=trim($service_id);
        $service_title = trim($service_title);
        $service_content = trim($service_content);
        $service_pay = trim($service_pay);

// Проверка.
        if ($service_title == '')
            return false;

// Запрос.
        $t = "UPDATE services SET service_title='%s', service_content='%s', service_pay='%s' WHERE service_id='$service_id'";

        $query = sprintf($t,
            mysql_real_escape_string($service_title),
            mysql_real_escape_string($service_content),
            mysql_real_escape_string($service_pay));

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }
//
//       Добавление новой фотографии для сервиса
//

function newServiceFoto($service_id, $service_foto_title, $service_foto_path){

    $service_id = trim($service_id);
    $service_foto_title = trim($service_foto_title);
    $service_foto_path = trim($service_foto_path);

$t = "INSERT INTO services_foto (service_id, service_foto_title, service_foto_path)   VALUES ('%s', '%s', '%s')";

$query = sprintf($t,
mysql_real_escape_string($service_id),
mysql_real_escape_string($service_foto_title),
mysql_real_escape_string($service_foto_path));


$result = mysql_query($query);

if (!$result)
die(mysql_error());

return true;
}
//
// Удалить статью
//
    function service_delete($id)
    {
// Запрос.
        $query = "DELETE FROM services WHERE service_id='$id'";

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }

    function service_foto_delete($id)
    {
// Запрос.
        $query = "DELETE FROM services_foto WHERE service_id='$id'";

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