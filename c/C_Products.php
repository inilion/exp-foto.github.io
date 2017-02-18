<?php
//
// Конттроллер статей
//
include_once 'functions/fcs.php';
class C_Products extends C_Base
{

    //
    // Конструктор.
    //
    function __construct()
    {

        parent::__construct();

    }

public function action_index(){

        $this->title=$this->title.' :: Все Товары';

        // получение экземпляра модели
        $mProducts = M_Articles::Instance();

        // обращение к модели
        $this->articles = $mProducts;
        $products = $mProducts->articles_all();


    foreach($products as $key ){
        $product_id = $key['product_id'];

        $productFoto = $mProducts->product_get_ALL_Photo($product_id);
        $key ['product_img'] = $productFoto;
        $productWithFoto [] = $key;

    }




        $this->content = $this->Template('v/v_index_product.php', array('products'=>$productWithFoto,
                                                                        'productFoto'=>$productFoto));
    }

public function action_newProduct(){

       $this->title.' :: Добавить продукт';

    if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
        $this->redirect('/auth/login');

            // получение экземпляра модели
            $mArticles = M_Articles::Instance();

            // обращение к модели
            $this->articles = $mArticles;



            $articles = $mArticles->articles_all();

         foreach($articles as $key ){
             $product_id = $key['product_id'];

             $productFoto = $mArticles->product_get_ALL_Photo($product_id);

          //   if($productFoto == null)
          //   {
          //       $productFoto ='/I_M_G/faw.jpg';
          //   }

             $key ['product_img'] = $productFoto;
             $productWithFoto [] = $key;

         }
   // var_dump($productFoto);
   // var_dump($productWithFoto);
   // die;
            $this->content = $this->Template('v/v_product_add.php', array('articles' => $articles,
                                                                            'productWithFoto' => $productWithFoto));



     if($this->IsPost() ) {
            //   var_dump($_FILES['Product_img']);
            //   die;
            //  text_set($_POST['text']);
            //    header('location: index.php?x='. time());
            //   exit();

            $FileProduct = $_FILES['Product_img'];

            $product_title = $_POST['Product_title'];
            $product_content = $_POST['Product_content'];
            $product_pay = $_POST['Product_pay'];
            $product_img = File_upload($FileProduct);
            $this->content = $this->Template('v/v_index_product.php',
                array('Product_title' => $product_title,
                    'Product_content' => $product_content,
                    'Product_pay' => $product_pay,
                    'Product_img' => $product_img));


            // получение экземпляра модели
            $mArticles = M_Articles::Instance();

            // обращение к модели
            $this->articles = $mArticles;

            $Newarticles = $mArticles->articles_new($product_title, $product_content, $product_pay, $product_img);
//var_dump($Newarticles);die;
            $articles = $mArticles->articles_all();



            $this->content = $this->Template('v/v_product_edit.php', array('articles' => $articles,
                                                                            'productWithFoto' => $productWithFoto));
            header('location: /product/editProduct&id='. $Newarticles);
            exit();
     }

    }

public function action_oneProduct()
    {

        $this->title = $this->title . ' :: ПРОДУКТ';

        //   var_dump($_GET["id"]);
        //   die;/

        $product_id = $_GET["id"];
        // получение экземпляра модели
        $mProducts = M_Articles::Instance();

        // обращение к модели
        $this->articles = $mProducts;

        $products = $mProducts->articles_all();

        $articles=$mProducts->product_get($product_id);
        foreach($products as $key ){


            $productFoto = $mProducts->product_get_ALL_Photo($product_id);
            //var_dump($productFoto);
           // die;
            $key ['product_img'] = $productFoto;
            $productWithFoto [] = $key;

        }

        $this->title = $articles["product_title"];
        $this->content = $this->Template('v/v_product_one.php', array('articles' => $articles,
                                                                      'productFoto' => $productFoto,
                                                                        'productWithFoto' => $productWithFoto));
       // header('location: index.php?c=product&act=oneProduct&id='. $product_id);

    }

public function action_editProduct()
    {
        if(!M_Users::Instance()->Can('USE_SECRET_FUNCTIONS'))
            $this->redirect('/auth/login');

        $this->title = $this->title . ' :: ИЗМЕНЕНИЕ ПРОДУКТА';

         //  var_dump($_GET["id"]);
         // die;
        if($this->IsGet() && isset( $_GET["id"]) ) {
            $product_id = $_GET["id"];
            // получение экземпляра модели
           //var_dump($_GET["id"]);
           // die;
            $product_id = $_GET["id"];
            $mArticles = M_Articles::Instance();

            // обращение к модели
            $this->product = $mArticles;

            $product=$mArticles->product_get($product_id);
            $productFoto = $mArticles->product_get_ALL_Photo($product_id);
            //var_dump($productFoto);die;
            $this->content = $this->Template('v/v_product_edit_one.php', array('product' => $product,
                                                                                'productFoto' => $productFoto));
          //   header('location: index.php?c=product&act=editProduct&id='. $product_id);
//exit();
        }
        if($this->IsPost() ) {

            $product_id = $_GET["id"];
            // получение экземпляра модели
            $mArticles = M_Articles::Instance();

            // обращение к модели
            $this->articles = $mArticles;

            $articles=$mArticles->product_get($product_id);

            /////////////////Добавление фото для сервиса
            if($_FILES['Product_img']['error'] == '0'){
                $FileProduct = $_FILES['Product_img'];
                $product_foto = File_upload($FileProduct);
                $product_foto_id = $product_id;
                $product_foto_title =$product_foto;
                $product_foto_path = $product_foto;
                $FotoProduct=$mArticles->newProductFoto($product_id, $product_foto_title, $product_foto_path);
                //  var_dump($_FILES['Product_img']['error']);
                //  die;
            }

            if($_POST["Delete"]){

                $del = $mArticles->product_delete($product_id);
                $dele = $mArticles->product_foto_delete($product_id);
                var_dump($dele);

            }

            //var_dump($_POST['Product_pay']);
            // die;
            $productFoto = $mArticles->product_get_ALL_Photo($product_id);
           // $FileProduct = $_FILES['Product_img'];

            $product_title = $_POST['Product_title'];
            $product_content = $_POST['Product_content'];
            $product_pay = $_POST['Product_pay'];
            //  $product_img = File_upload($FileProduct);

            // получение экземпляра модели
            $mArticles = M_Articles::Instance();

            // обращение к модели
            $this->articles = $mArticles;
            $articles=$mArticles->product_edit($product_id, $product_title, $product_content, $product_pay);
            //var_dump($this);
            //die;


            $this->content = $this->Template('v/v_product_edit_one.php', array('product' => $product));
             header('location: /product/editProduct&id='. $product_id);

        }
        // получение экземпляра модели
            $mArticles = M_Articles::Instance();
//var_dump();

            // обращение к модели
            $this->articles = $mArticles;

            $articles = $mArticles->articles_all();

    $productFoto = $mArticles->product_get_ALL_Photo($product_id);

    foreach($articles as $key ){
        $product_id = $key['product_id'];

        $productssFoto = $mArticles->product_get_ALL_Photo($product_id);
        $key ['product_img'] = $productssFoto;
        $productWithFoto [] = $key;

    }

            $this->content = $this->Template('v/v_product_edit.php', array('articles' => $articles,
                                                                            'product' => $product,
                                                                            'productFoto' => $productFoto,
                                                                            'productWithFoto' => $productWithFoto));
            // header('location: index.php?c=product&act=oneProduct&id='. $product_id



    }

public  function  action_DeleteProduct(){
    var_dump($_POST);
      die;
}

}