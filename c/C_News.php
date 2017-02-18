<?php
//
// Конттроллер статей
//
include_once 'functions/fcs.php';
class C_News extends C_Base
{

    //
    // Конструктор.
    //
    function __construct()
    {

        parent::__construct();

    }

    public function action_index(){

        $this->title=$this->title.' :: Новости сайта';

        // получение экземпляра модели
        $mNews = M_News::Instance();

        // обращение к модели
        $this->newss = $mNews;
        $news = $mNews->news_all();




        foreach($news as $key ){
            $news_id = $key['news_id'];

            $newsFoto = $mNews->news_get_ALL_Photo($news_id);
            $key ['news_img'] = $newsFoto;
            $newsWithFoto [] = $key;

        }


        $this->content = $this->Template('v/v_index_news.php', array('newss'=>$newsWithFoto,
            'newsFoto'=>$newsFoto));
    }


    public function action_newNews(){
        if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
            $this->redirect('/auth/login');
        $this->title=$this->title.' :: Добавить news';
        if($this->IsGet() ) {


            $FileNews = $_FILES['news_img'];

            $news_title = $_POST['news_title'];
            $news_content = $_POST['news_content'];




            // получение экземпляра модели
            $mNews = M_News::Instance();

            // обращение к модели
            $this->newss = $mNews;

            $Newnews = $mNews->news_new($news_title, $news_content);

            $newss = $mNews->news_all();

            foreach($newss as $key ){
                $news_id = $key['news_id'];

                $newsFoto = $mNews->news_get_ALL_Photo($news_id);
                $key ['news_img'] = $newsFoto;
                $newsWithFoto [] = $key;

            }



            $this->content = $this->Template('v/v_news_add.php', array('newss' => $newsWithFoto));

        }

        if($this->IsPost() ) {


            $news_title = $_POST['news_title'];
            $news_content = $_POST['news_content'];


            // получение экземпляра модели
            $mNews = M_News::Instance();

            // обращение к модели
            $this->newss = $mNews;

            $NewNews = $mNews->news_new($news_title, $news_content);

            $news = $mNews->news_all();




            $this->content = $this->Template('v/v_index_news.php', array('newss' => $news));
            header('location: /news/editNews&id='. $NewNews);
            exit();
        }

    }

    public function action_oneNews()
    {

        $this->title = $this->title . ' :: one News';

        $news_id = $_GET["id"];
        // получение экземпляра модели
        $mNews = M_News::Instance();

        // обращение к модели
        $this->newss = $mNews;

        $news=$mNews->news_get($news_id);

        $newsFoto = $mNews->news_get_ALL_Photo($news_id);


        $this->content = $this->Template('v/v_service_one.php', array('newss' => $news,
            'newsFoto'=> $newsFoto));
        // header('location: index.php?c=product&act=oneProduct&id='. $product_id);

    }




    public function action_editNews()
    {
        if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
            $this->redirect('/auth/login');

        $this->title = $this->title . ' :: ИЗМЕНЕНИЕ news';

        // var_dump($_GET["id"]);
        //  die;
        if($this->IsGet() & isset( $_GET["id"]) ) {
            //  $product_id = $_GET["id"];
            // получение экземпляра модели
            // var_dump('it itith Get');
            //  die;
            $news_id = $_GET["id"];
            $mNews = M_News::Instance();

            // обращение к модели
            $this->news = $mNews;

            $news=$mNews->news_get($news_id);
            //var_dump($news);die;
            $newsFoto = $mNews->news_get_ALL_Photo($news_id);

            $this->content = $this->Template('v/v_news_edit.php', array('news' => $news,
                'newsFoto' => $newsFoto));

        }
        if($this->IsPost() ) {
            // var_dump($_POST);
            //  die;
            // var_dump('it itiz Post');
            // die;
            $news_id = $_GET["id"];
            $mNews = M_News::Instance();

            // обращение к модели
            $this->news = $mNews;

            $news=$mNews->news_get($news_id);
            //$product_id = $_GET["id"];

            /////////////////Добавление фото для сервиса
            if($_FILES['news_img']['error'] == '0'){
                $FileNews = $_FILES['news_img'];
                $news_foto = File_upload_service($FileNews);

                $news_foto_title =$news_foto;
                $news_foto_path = $news_foto;
                $FotoNews=$mNews->newNewsFoto($news_id, $news_foto_title, $news_foto_path);
                //  var_dump($_FILES['Product_img']['error']);
                //  die;

            }

            if($_POST["Delete"]){

                $del = $mNews->news_delete($news_id);
                $dele = $mNews->news_foto_delete($news_id);


            }
            $newsFoto = $mNews->news_get_Photo($news_id);
            // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
            // die;
            $news_title = $_POST['news_title'];
            $news_content = $_POST['news_content'];


            // получение экземпляра модели
            $mNews = M_News::Instance();

            // обращение к модели
            $this->newss = $mNews;
            $news=$mNews->news_edit($news_id, $news_title, $news_content);

            $this->content = $this->Template('v/v_news_edit.php',
                array('news_title' => $news_title,
                    'news_content' => $news_content,
                    'newsfoto' => $newsFoto));


        }


        $news_id = $_GET["id"];
        // получение экземпляра модели
        $mNews = M_News::Instance();
        //var_dump('it itiz Post');
        // die;

        // обращение к модели
        $this->newss = $mNews;

        //var_dump($serviceFoto);
        $newss = $mNews->news_all();

        $newsFoto = $mNews->news_get_ALL_Photo($news_id);

        foreach($newss as $key ){
            $news_id = $key['news_id'];

            $newssFoto = $mNews->news_get_ALL_Photo($news_id);
            $key ['news_img'] = $newssFoto;
            $newsWithFoto [] = $key;

        }


         //var_dump($newsWithFoto); die;

        $this->content = $this->Template('v/v_news_edit.php', array( 'newss' => $newss,
            'news' => $news,
            'newsFoto' => $newsFoto,
            'newsWithFoto' => $newsWithFoto));
        // header('location: index.php?c=product&act=oneProduct&id='. $product_id



    }

}