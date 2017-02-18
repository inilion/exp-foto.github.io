<?php
//
// Конттроллер статей
//
include_once 'functions/fcs.php';
class C_Photo_services extends C_Base
{

    //
    // Конструктор.
    //
    function __construct()
    {

        parent::__construct();

    }

    public function action_index(){

        $this->title=$this->title.' :: Наши услуги';

        // получение экземпляра модели
        $mService = M_Service::Instance();

        // обращение к модели
        $this->services = $mService;
        $services = $mService->service_all();




        foreach($services as $key ){
            $service_id = $key['service_id'];

            $serviceFoto = $mService->service_get_ALL_Photo($service_id);
            $key ['service_img'] = $serviceFoto;
            $servicesWithFoto [] = $key;

        }


        $this->content = $this->Template('v/v_index_services.php', array('services'=>$servicesWithFoto,
                                                                         'serviceFoto'=>$serviceFoto));
    }


    public function action_newServices(){
        if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
            $this->redirect('/auth/login');
        $this->title=$this->title.' :: Добавить services';
        if($this->IsGet() ) {


            $FileService = $_FILES['Service_img'];

            $service_title = $_POST['Service_title'];
            $service_content = $_POST['Service_content'];
            $service_pay = $_POST['Service_pay'];
            $service_img = File_upload_service($FileService);
            $service_foto_title = $service_img;
            $service_foto_path = $service_img;

            $this->content = $this->Template('v/v_index_services.php',
                array('Service_title' => $service_title,
                    'Service_content' => $service_content,
                    'Service_pay' => $service_pay,
                    'Service_img' => $service_img));


            // получение экземпляра модели
            $mServices = M_Service::Instance();

            // обращение к модели
            $this->services = $mServices;

            $NewServices = $mServices->service_new($service_title, $service_content, $service_pay, $service_img, $service_foto_title, $service_foto_path);

            $services = $mServices->service_all();

            foreach($services as $key ){
                $service_id = $key['service_id'];

                $serviceFoto = $mServices->service_get_ALL_Photo($service_id);
                $key ['service_img'] = $serviceFoto;
                $servicesWithFoto [] = $key;

            }



            $this->content = $this->Template('v/v_service_add.php', array('services' => $servicesWithFoto));

        }

        if($this->IsPost() ) {


            $FileService =  $_FILES["Service_img"];


            $service_title = $_POST['Service_title'];
            $service_content = $_POST['Service_content'];
            $service_pay = $_POST['Service_pay'];
            $service_img = File_upload_service($FileService);

            $this->content = $this->Template('v/v_index_services.php',
                array('Service_title' => $service_title,
                    'Service_content' => $service_content,
                    'Service_pay' => $service_pay,
                    'Service_img' => $service_img));


            // получение экземпляра модели
            $mServices = M_Service::Instance();

            // обращение к модели
            $this->services = $mServices;

            $NewServices = $mServices->service_new($service_title, $service_content, $service_pay, $service_img, $service_foto_title, $service_foto_path);

            $services = $mServices->service_all();




            $this->content = $this->Template('v/v_index_services.php', array('services' => $services));
            header('location: /Photo_services/editService&id='. $NewServices);
            exit();
        }

    }

    public function action_oneService()
    {



        $service_id = $_GET["id"];
        // получение экземпляра модели
        $mService = M_Service::Instance();

        // обращение к модели
        $this->services = $mService;

        $services=$mService->service_get($service_id);

        $serviceFoto = $mService->service_get_ALL_Photo($service_id);
        $this->title =  $services["service_title"];

        $this->content = $this->Template('v/v_service_one.php', array('services' => $services,
                                                                        'servicesFoto'=> $serviceFoto));
        // header('location: index.php?c=product&act=oneProduct&id='. $product_id);

    }




    public function action_editService()
    {
        if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
            $this->redirect('/auth/login');

        $this->title = $this->title . ' :: ИЗМЕНЕНИЕ Сервиса';

        // var_dump($_GET["id"]);
        //  die;
        if($this->IsGet() && isset( $_GET["id"]) ) {
          //  $product_id = $_GET["id"];
            // получение экземпляра модели
           // var_dump('it itith Get');
           //  die;
            $service_id = $_GET["id"];
            $mService = M_Service::Instance();

            // обращение к модели
            $this->service = $mService;

            $service=$mService->service_get($service_id);

            $serviceFoto = $mService->service_get_ALL_Photo($service_id);
            $this->content = $this->Template('v/v_service_edit.php', array('service' => $service,
                                                                            'serviceFoto' => $serviceFoto));

        }
        if($this->IsPost() ) {
           // var_dump($_POST);
          //  die;
           // var_dump('it itiz Post');
           // die;
            $service_id = $_GET["id"];
            $mServices = M_Service::Instance();

            // обращение к модели
            $this->service = $mServices;

            $service=$mServices->service_get($service_id);
            //$product_id = $_GET["id"];

   /////////////////Добавление фото для сервиса
            if($_FILES['Product_img']['error'] == '0'){
                    $FileService = $_FILES['Product_img'];
                    $service_foto = File_upload_service($FileService);
                    $service_foto_id = $service_id;
                    $service_foto_title =$service_foto;
                    $service_foto_path = $service_foto;
                $FotoService=$mServices->newServiceFoto($service_id, $service_foto_title, $service_foto_path);
              //  var_dump($_FILES['Product_img']['error']);
              //  die;
            }
            if($_POST["Delete"]){

                $del = $mServices->service_delete($service_id);
                $dele = $mServices->service_foto_delete($service_id);


            }
            $serviceFoto = $mServices->service_get_Photo($service_id);
           // var_dump($serviceFoto);//string(22) "/I_M_G_Service/faw.jpg"
           // die;
            $service_title = $_POST['Service_title'];
            $service_content = $_POST['Service_content'];
            $service_pay = $_POST['Service_pay'];

            // получение экземпляра модели
            $mService = M_Service::Instance();

            // обращение к модели
            $this->services = $mService;
            $services=$mService->service_edit($service_id, $service_title, $service_content, $service_pay);

            $this->content = $this->Template('v/v_service_edit.php',
                array('Service_title' => $service_title,
                    'Service_content' => $service_content,
                    'Service_pay' => $service_pay));


        }


        $service_id = $_GET["id"];
        // получение экземпляра модели
        $mService = M_Service::Instance();
      //var_dump('it itiz Post');
      // die;

        // обращение к модели
        $this->services = $mService;
        $this->service_foto = $mService;
        //var_dump($serviceFoto);
        $services = $mService->service_all();

        $serviceFoto = $mService->service_get_ALL_Photo($service_id);

        foreach($services as $key ){
            $service_id = $key['service_id'];

            $servicFoto = $mService->service_get_ALL_Photo($service_id);
            $key ['service_img'] = $servicFoto;
            $servicesWithFoto [] = $key;

        }


      //  var_dump($this);
      //  die;
        $this->content = $this->Template('v/v_service_edit.php', array( 'services' => $services,
                                                                        'service' => $service,
                                                                        'serviceFoto' => $serviceFoto,
                                                                        'servicesWithFoto' => $servicesWithFoto));
        // header('location: index.php?c=product&act=oneProduct&id='. $product_id



    }

}