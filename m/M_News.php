<?php


class M_News
{
    private static $instance; // ссылка на экземпляр класса
    private  $conn; // ссылка на экземпляр класса

//
// Получение единственного экземпляра (одиночка).
//
    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new M_News();

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

    function news_all()
    {
// Запрос.
        $query = "SELECT * FROM news ORDER BY news_id DESC";
        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

// Извлечение из БД.
        $n = mysql_num_rows($result);
        $news = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $news[] = $row;
        }
//var_dump($services);
//        die;
        return $news;
    }

//
// Конкретная статья
//
    public function news_get($news_id)
    {
// Запрос.
        $query = "SELECT * FROM news WHERE news_id='$news_id'";
        $result = mysql_query($query);
//var_dump($result);
        //  die;
        if (!$result)
            die(mysql_error());

        $news = mysql_fetch_assoc($result);

        return $news;
    }


// Конкретная сервис с фотографиями
//
    public function news_get_Photo($news_id)
    {
// Запрос.
        $query = "SELECT * FROM news_foto WHERE news_id";
        $result = mysql_query($query);
//var_dump($result);
        //    die;
        if (!$result)
            die(mysql_error());
// Извлечение из БД.
        $n = mysql_num_rows($result);
        $newsFoto = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $newsFoto[] = $row;
        }

        // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
        // die;
        return $newsFoto;
    }


    // Конкретная сервис с фотографиями
//
    public function news_get_ALL_Photo($news_id)
    {
// Запрос.
        $query = "SELECT news_foto_path FROM  news_foto WHERE news_id ='$news_id'";
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
        $newsFoto = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysql_fetch_assoc($result);
            $newsFoto[] = $row;
        }

        // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
        // die;
        return $newsFoto;
    }

//
// Добавить статью
//
    function news_new($news_title, $news_content)
    {
// Подготовка.
        $news_title = trim($news_title);
        $news_content = trim($news_content);

        // $service_img = trim($service_img);
        ////foto//
        //   $service_foto_title = trim($service_foto_title);
        //   $service_foto_path = trim($service_foto_path);

        //var_dump($service_img);
        // die;
// Проверка.
        if ($news_title == '')
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
        $t = "INSERT INTO news (news_title, news_content)   VALUES ('%s', '%s')";

        $query = sprintf($t,
            mysql_real_escape_string($news_title),
            mysql_real_escape_string($news_content));

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        //   return true;


        return mysql_insert_id();
    }

//
// Изменить статью
//
    function news_edit($news_id, $news_title, $news_content)
    {
// Подготовка.
        $news_id=trim($news_id);
        $news_title = trim($news_title);
        $news_content = trim($news_content);


// Проверка.
        if ($news_title == '')
            return false;

// Запрос.
        $t = "UPDATE news SET news_title='%s', news_content='%s' WHERE news_id='$news_id'";

        $query = sprintf($t,
            mysql_real_escape_string($news_title),
            mysql_real_escape_string($news_content));

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }
//
//       Добавление новой фотографии для сервиса
//

    function newNewsFoto($news_id, $news_foto_title, $news_foto_path){

        $news_id = trim($news_id);
        $news_foto_title = trim($news_foto_title);
        $news_foto_path = trim($news_foto_path);

        $t = "INSERT INTO news_foto (news_id, news_foto_title, news_foto_path)   VALUES ('%s', '%s', '%s')";

        $query = sprintf($t,
            mysql_real_escape_string($news_id),
            mysql_real_escape_string($news_foto_title),
            mysql_real_escape_string($news_foto_path));


        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }
//
// Удалить статью
//
    function news_delete($id)
    {
// Запрос.
        $query = "DELETE FROM news WHERE news_id='$id'";

        $result = mysql_query($query);

        if (!$result)
            die(mysql_error());

        return true;
    }

    function news_foto_delete($id)
    {
// Запрос.
        $query = "DELETE FROM news_foto WHERE news_id='$id'";

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