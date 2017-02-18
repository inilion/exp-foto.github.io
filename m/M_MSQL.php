<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;	// экземпляр класса

	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_MSQL();
			
		return self::$instance;
	}

	private function __construct()
	{
		// Языковая настройка.
		setlocale(LC_ALL, 'UTF-8');

		// Подключение к БД.
		mysql_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) or die('No connect with data base');
		mysql_query('SET NAMES UTF-8');
		mysql_select_db(MYSQL_DB) or die('No data base');
	}


	public function query($query)
	{

//func_num_args -  Возвращает количество аргументов, переданных функции

		if(($num_args = func_num_args()) > 1){
			$arg  = func_get_args();
			unset($arg[0]);
			//Выводит значения массива args, отформатированные в соответствии с аргументом format,

//var_dump($arg);die;
			foreach($arg as $argument=>$value){

				$arg[$argument]=mysql_real_escape_string($value); // экранируем кавычки для всех входных параметров
				}

			$query = vsprintf($query,$arg);
			//var_dump($query);die;
		}

		$sql = mysql_query($query);

		if(preg_match('`^(INSERT|UPDATE|DELETE|REPLACE)`i',$query,$null)){
			if($this->affected_rows($sql)){
				return $sql;
			}
		}else{
			if($this->num_rows($sql)){
				return $sql;
			}
		}

		return false;
	}


	//
	// Выборка строк
	// $query    	- полный текст SQL запроса
	// результат	- массив выбранных объектов
	//
	public function Select($query)
	{
		header('Content-type: text/html; charset= UTF-8');
		$result = mysql_query($query);
		
		if (!$result)
			die(mysql_error());
		
		$n = mysql_num_rows($result);
		$arr = array();
	
		for($i = 0; $i < $n; $i++)
		{
			$row = mysql_fetch_assoc($result);		
			$arr[] = $row;
		}

		return $arr;				
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
		foreach ($object as $key => $value)
		{
			$key = mysql_real_escape_string($key . '');
			$columns[] = $key;
			
			if ($value === null)
			{
				$values[] = 'NULL';
			}
			else
			{
				$value = mysql_real_escape_string($value . '');

				$values[] = "'$value'";

			}
			}

		$columns_s = implode(',', $columns);

		$values_s = implode(',', $values);

		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = mysql_query($query);
								
		if (!$result)
			die(mysql_error());

		return mysql_insert_id();

	}

public function insert_id()
	{
		return mysql_insert_id();
	}

	// Изменение строк
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	//	
	public function Update($table, $object, $where)
	{
		$sets = array();
	
		foreach ($object as $key => $value)
		{
			$key = mysql_real_escape_string($key . '');
			
			if ($value === null)
			{
				$sets[] = "$key=NULL";			
			}
			else
			{
				$value = mysql_real_escape_string($value . '');					
				$sets[] = "$key='$value'";			
			}			
		}
		
		$sets_s = implode(',', $sets);			
		$query = "UPDATE $table SET $sets_s WHERE $where";
		$result = mysql_query($query);
		
		if (!$result)
			die(mysql_error());

		return mysql_affected_rows();	
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
		$result = mysql_query($query);
						
		if (!$result)
			die(mysql_error());

		return mysql_affected_rows();	
	}
}
