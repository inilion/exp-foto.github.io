<?php
//
// Помощник работы с БД
//
class M_db_driver extends mysqli
{
	static $inst;

//	private $hostname='127.0.0.1';
//	private $username='root';
//	private $password='1234';
//	private $dbName='expert';

	 function __construct()
	{

		// здесь подключение к базе
			parent::__construct(
				'127.0.0.1',
				'root',
				'1234',
				'expert');

			$this->query('SET NAMES UTF-8');



	}


	static function Instance()
	{
		if (isset(self::$inst))
		//	$c = __CLASS__;
		self::$inst = new M_db_driver();

		return self::$inst;
		//var_dump($inst);
		//die;
	}



	//
	// Выборка строк
	// $query    	- полный текст SQL запроса
	// результат	- массив выбранных объектов
	//



	public function Select($table,$fields)
	{


		$articles = array();
		$qry = "SELECT ". implode(', ',$fields)." FROM $table";
		if ($result = $this->query($qry)){
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$articles[] = $row;
			}
		}
		else{
			if (!$result)
				die('Ошибка запроса: '.$this->error);
		}
			return $articles;
	}

	//
	// Вставка строки
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// результат	- идентификатор новой строки
	//
	public function Insert($table, $object)
	{
		$columns = array();
		$values = array();

		foreach ($object as $key => $value) {
			$key = real_escape_string($key . '');
			$columns[] = $key;

			if ($value === null) {
				$values[] = 'NULL';
			} else
				$value = $this->real_escape_string($value . '');
			$values[] = "'$value'";
		}


		$columns_s = implode(',', $columns);
		$values_s = implode(',', $values);

		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = $this->query($query);

		if (!$result)
			die($this->error);

		return $this->insert_id;
	}

	//
	// Изменение строк
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	//	
	public function Update($table, $object, $where)
	{
		$sets = array();

		foreach ($object as $key => $value) {
			$key = $this->real_escape_string($key . '');

			if ($value === null)
			{
				$sets[] = "$value=NULL";
			}
			else
			{
				$value = $this->real_escape_string($value . '');
				$sets[] = "$key='$value'";
			}
		}

		$sets_s = implode(',', $sets);
		$query = "UPDATE $table SET $sets_s WHERE $where";
		$result = $this->query($query);

		if (!$result)
			die($this->error);

		return $this->affected_rows();
	}

	//
	// Удаление строк
	// $table 		- имя таблицы
	// $where		- условие (часть SQL запроса)	
	// результат	- число удаленных строк
	//		
	public function Delete($table, $where)
	{
		$query = "DELETE FROM $table WHERE $where";
		$result = $this->query($query);

		if (!$result)
			die($this->error);

		return $this->affected_rows();
	}
}

