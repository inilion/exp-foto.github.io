<?php
include_once('/m/M_MSQL.php');
//Модель оформления заказа
 class M_Order  // наследует все методы класса для работы с бд
  {
		private $fio;
		private $email;
		private $phone;
		private $adres;

	 public function __construct()
	 {
		 $this->msql = M_MSQL::Instance();

	 }
		// проверка на корректность ввода данных
		function isValidData($array_data){
			//корректность емайл



			// заполненность адреса
			if(!trim($array_data['email'])){
			  $error="Корректно заполните форму !";


			}
			if(!trim($array_data['phone'])){
				$error="Корректно заполните форму !";

			}
			if(!trim($array_data['adres'])){
				$error="Корректно заполните форму !";
			}
			//если нет ощибок, то заносим информацию в поля класса
			if($error)return $error;
			else{
				$this->fio=trim($array_data['fio']);
				$this->email=trim($array_data['email']);
				$this->phone=trim($array_data['phone']);
				$this->adres=trim($array_data['adres']);
				return false;
			}

		}


	 //////////

	 function getAllOrders(){

		 $query = "SELECT * FROM orders ORDER BY date_order";
		 $allOrders = $this->msql->Select($query);

		 foreach($allOrders as $allOrder) {

			 $unserial = stripcslashes ($allOrder["order_content"]);

			 $allOrder["order_content"] = unserialize($unserial);

			 $allOrderss[] = $allOrder;

		 }

		 return $allOrderss;
	 }


	//добавление заявки
	function addOrder(){
		header('Content-type: text/html; charset= UTF-8');
		$mArticles = M_Articles::Instance();
		$item_position = $mArticles;
		//добавляем в массив корзины третий параметр  цены товара, для сохранения в заказ
		// это нужно для того чтобы в последствии вывести детальную информацию о заказе.
		//Если оставить только id то информация может оказаться не верной, так как цены меняютмя.
		foreach($_SESSION['cart'] as $product_id=>$count){
			$price=$item_position->getProductPrice($product_id);
			$pay = $price->product_pay;

			$product_positions[$product_id] = array(
			"price"=>$pay,
			"count"=>$count

			);
			//var_dump($product_positions);die;
		}

		// сериализуем данные в строку для записи в бд
		$order_content=addslashes(serialize($product_positions));

		// создаем новую модель корзины чтобы узнать сумму заказа
		$cart = new M_Cart();
		$summ = $cart->getTotalSumm();

		//формируем массив параметров SQL запроса
		$array=array(

			"name_user"=>$this->fio,
			"e_mail"=>$this->email,
			"phone"=>$this->phone,
			"user_adr"=>$this->adres,
			"summ"=>$summ,
			"order_content"=>$order_content
		);
//var_dump($array);
		// отдаем на обработку  родительской функции build_query


		$this->msql->Insert('orders', $array);

		$id = $this->msql->insert_id(); //заказ номер id добавлен в базу

		if($id) {

			$cart->clearCart();// если заказ успешно записан, то отчищаем корзину
		}
			return $id; // возвращаем номер заказа
	}


	 // возвращает html код корзины
	 function printOrder()
	 {
		 $array_product_id=$this->getListItemId(); // получает список id

		 $mArticles = M_Articles::Instance();
		 $item_position = $mArticles;	// создаем модель для работы с продуктами
		 foreach($array_product_id as $id){

			 $product_positions[]=$item_position->product_get($id); // заполняем массив информацией о каждом продукте
			 //var_dump($product_positions);die;
		 }
		 // формируем интерфейс для работы с корзиной
		 $table_cart="<table bgcolor='#E6DEEA' border='1' class='table_cart'><tr><th>№</th><th>Наименование</th><th>Стоимость</th><th>Количество</th><th>Сумма</th><th>Удалить</th></tr>";
		 $i=1;
		 foreach($product_positions as $product)
		 {
			 //var_dump($_SESSION['cart'][$product['product_id']]);die;
			 if ($i%2==0) $bgcolor="#D5C4FF"; else $bgcolor="#92C7FF";
			 $table_cart.="<tr bgcolor=$bgcolor>";
			 $table_cart.="<td>".$i++."</td>";
			 $table_cart.="<td>".$product['product_title']."</td>";
			 $table_cart.="<td>".$product['product_pay']." руб. </td>";
			 $table_cart.="<td><input type='text' style='text-align:center' size=3 name='item_".$product['product_id']."' value='".$_SESSION['cart'][$product['product_id']]."' /></td>";
			 $table_cart.="<td>".$_SESSION['cart'][$product['product_id']]*$product['product_pay']." руб. </td>";
			 $table_cart.="<td>"."<INPUT TYPE='checkbox'  name='del_".$product['product_id']."'>"."</td>";
			 $table_cart.="</tr>";
			 $total_summ+=$_SESSION['cart'][$product['product_id']]*$product['product_pay'];
			 //var_dump($total_summ);die;
		 }
		 $table_cart.="<tr><td colspan='3'></td><td>К оплате: </td><td><strong> <span style='color: #7F0037'>".$total_summ." руб. </span></strong></td><td></td></tr></table>";

		 return $table_cart;
	 }

  }