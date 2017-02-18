<h2>Корзина</h2>

<?if($empty_cart):?>
<div class="Box_For_All_Cart">
		<form action="/cart/index" method="post">
			<?=$big_cart;?>
			<input class="type_for_reg" type="submit" name="refresh" value="Пересчитать"  style="margin-left:10px; margin-top:10px;" />

			<input  class="type_for_reg" type="submit" name="order" value="Оформить заказ" style=" height:30px; padding: 0px 20px;" />
		</form>
</div>
<?else:?>
	<div class="MSG"><b>Ваша корзина пуста!</b></div>

<?endif;?>