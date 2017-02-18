<?php
class C_Order extends C_Base
{
    //
    // Конструктор.
    //

    public function __construct()
    {
        parent::__construct();
        header('Content-type: text/html; charset= UTF-8');
    }



    public function action_index()
    {

        $dislpay_form = true; // показывать форму ввода данных
        if(isset($_REQUEST["order"])&& ($_REQUEST["adres"])){  // если пришли данные с формы

            $model = new M_Order;	//создаем модель заказа
            $error=$model->isValidData($_REQUEST);  //проверяем на корректность вода

            if($error)$this->error=$error; // если есть ошиби заносим их в переменную
            else{
                //если ошибок нет, то добавляем заказ в БД
                $order_id=$model->addOrder();

               // Lib_SmalCart::getInstance()->setCartData();// пересчитываем маленькую корзину
                header('Location: /order/index&thanks='.$order_id);
                exit;
            }
        }

        if(isset($_REQUEST["thanks"])){
            //формируем сообщение
           // var_dump($_SESSION);die;
            $message="Ваша заявка <strong>№ ".$_REQUEST["thanks"]."</strong> принята";
            $dislpay_form = false;//  форму ввода данных больше не покзываем

        }
        $this->content = $this->Template('v/v_order.php', array('error'=>$error, 'message'=>$message, 'dislpay_form'=>$dislpay_form,));
    }

    public function action_view_orders()
    {
        header('Content-type: text/html; charset= UTF-8');
        $model = new M_Order;	//создаем модель заказа
        $allOrders = $model->getAllOrders();
        //var_dump($allOrders);die;
        if(isset($_REQUEST["order"])&& ($_REQUEST["adres"])){  // если пришли данные с формы

        }
        $this->content = $this->Template('v/v_all_orders.php', array('allOrders'=>$allOrders));
        }
}