<?php
 class M_Cart
  {
	  function addToCart($id, $count=1)// доавляет в корзину товар
	  {

		$_SESSION['cart'][$id]=$_SESSION['cart'][$id]+$count;
		//  var_dump($_SESSION['cart']);die;
		return true;
	  }

	  function getListItemId() // возвращает список id продуктов из корзины
	  {
		$listId=array_keys($_SESSION['cart']);
		 // var_dump($listId);die;
		return $listId;
	  }

	  function getTotalSumm() // возвращает иготовую сумму корзины
	  {
		$array_product_id=$this->getListItemId();
		  $mArticles = M_Articles::Instance();// получаем списо id
		$item_position = $mArticles;// создаем модель для работы с продуктами

		foreach($array_product_id as $id){
			$product_positions[]=$item_position->product_get($id);// получаем информацию о каждом продукте
		}
		foreach($product_positions as $product)
		{
			$total_summ+=$_SESSION['cart'][$product['product_id']]*$product['product_pay'];// расчитываем сумму
		}

		return $total_summ;
	  }

	  // отчищает корзину
	 function clearCart(){
    unset($_SESSION['cart']);
  }

	  // обновляет содержимое корзины
	  function refreshCart($array_product_id){ // получает ассоциативный массив id=>count
		foreach($array_product_id as $Item_Id => $new_count){
			var_dump($array_product_id);
			if($new_count<=0){
				unset($_SESSION['cart'][$Item_Id]); // если количесво меньше нуля, то удаляем запись
			}
			else
				$_SESSION['cart'][$Item_Id]=$new_count; // присваиваем новое количество

		}

	  }

	  // проверка корзины на заполненность
	 function isEmptyCart(){
    if($_SESSION['cart']) return true;
    else return false;
    }

	  // возвращает html код корзины
	  function printCart()
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