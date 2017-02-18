<?php
class C_Cart extends C_Base
{
    //
    // Конструктор.
    //

    public function __construct()
    {
        parent::__construct();
        header('Content-type: text/html; charset= UTF-8');
    }

    public function before()
    {
        //$this->needLogin = true; // раскоментируйте, чтобы закрыть доступ ко всем страницам данного контроллера
        parent::before();
    }

  public  function action_AddIteem()
  {
      if($_REQUEST['in-cart-product-id']) {
          var_dump($_REQUEST);
          die;
      }
      $model=new M_Cart;
      $re = explode('cart/AddIteem/', $_REQUEST['q']);
      //var_dump($re[1]);die;
      $model->addToCart($re[1]);
//var_dump($_REQUEST);die;
      $_SESSION['MSG'] = 'Продукт успешно добавлен в корзину !';
      // Кодировка.

      header('Location: /product/oneProduct&id=' . $re[1]);
      exit;

  }

  public function action_index()
    {
        $model=new M_Cart;

        if($_REQUEST['refresh']){ // если пользователь изменил данные в корзине
            $list_Item_Id=$_REQUEST;

            foreach($list_Item_Id as $Item_Id => $new_count){//пробегаем по массиву , находим пометки на удаление и на изменение количества
                $id="";
                if(substr($Item_Id, 0, 5)=="item_") {
                    $id=substr($Item_Id, 5);
                    $count=$new_count;
                }
                elseif(substr($Item_Id, 0, 4)=="del_"){
                    $id=substr($Item_Id, 4);
                    $count=0;
                }

                if($id){
                    $array_product_id[$id]=(int)$count;
                }
            }


            $model->refreshCart($array_product_id); // передаем в модель данные для обновления корзины
           // Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
            header('Location: /cart/index');
            exit;

        }


        if($_REQUEST['clear']){ // если пользователь изменил данные в корзине

            $model->clearCart(); // передаем в модель данные для обновления корзины
            //Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
            header('Location: /cart/index');
            exit;

        }
        $empty_cart=$model->isEmptyCart();
        //var_dump($_REQUEST);die;
        if ($empty_cart) {
            $big_cart = $model->printCart(); //выводим список позиций к заказу()

        }// var_dump($big_cart);die;
        //$this->big_cart=$big_cart; //в представлении он будет доступен через переменную $big_cart
        if($_REQUEST['order']){ // если пользователь изменил данные в корзине

             //Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
            header('Location: /order/index');
            exit;

        }

        $this->content = $this->Template('v/v_cart.php', array('big_cart' => $big_cart,
                                                               'empty_cart' => $empty_cart));
    }


}
?>