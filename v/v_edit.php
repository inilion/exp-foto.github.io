<?php
/**
 * Шаблон редактора
 * ================
 * $text - текст статьи
 */
?>
<div class="Box_first">
	<form method="post">
		<textarea name="text"><?=$text?></textarea>
		<br/>
		<input type="submit" value="Сохранить" />
	</form>
</div>