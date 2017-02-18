<?php
//
// Конттроллер страницы чтения.
//
include_once('/m/model.php');
include_once('/m/startup.php');
class C_Page extends C_Base
{
	//
	// Конструктор.
	//

	public function __construct(){
		parent::__construct();
	}

	public function before(){
		//$this->needLogin = true; // раскоментируйте, чтобы закрыть доступ ко всем страницам данного контроллера
		parent::before();
	}

	public function action_login(){
		$this->title .= '::login';

				$this->redirect('/auth/login');

// Кодировка.
		header('Content-type: text/html; charset= UTF-8');

		}
	public function action_index(){
		//$this->title .= '::Чтение';

// Установка параметров, подключение к БД, запуск сессии.
		startUup();
		//var_dump($_SESSION);die;
// Менеджеры.
		$mUsers = M_Users::Instance();
		$mUsers->ClearSessions();
		$user = $mUsers->Get();


		$mService = M_Service::Instance();

		// обращение к модели
		$this->services = $mService;
		$services = $mService->service_all();

		foreach($services as $key ) {
			$service_id = $key['service_id'];

			$serviceFoto = $mService->service_get_ALL_Photo($service_id);
			$key ['service_img'] = $serviceFoto;
			$servicesWithFoto [] = $key;

		}


		$mArticles = M_Articles::Instance();

		// обращение к модели
		$this->articles = $mArticles;
		$articles = $mArticles->articles_all();

///////////////// НОВОСТИ САЙТА//////////////////////////////////////////

		$mNews = M_News::Instance();

		$this->news = $mNews;
		$news = $mNews->news_all();
////Добовляем фото из базы в массив с новостями////////////////////
		foreach($news as $key ) {
			$news_id = $key['news_id'];

			$newsFoto = $mNews->news_get_ALL_Photo($news_id);
			$key ['news_img'] = $newsFoto;
			$newsWithFoto [] = $key;

		}

		$this->content = $this->Template('v/v_index.php', array('user' =>$user,
																'services' =>$services,
																'servicesFoto' =>$servicesWithFoto,
																'product' =>$articles,
																'news' =>$newsWithFoto,
												'can_use' => M_Users::Instance()->Can('USE_SECRET_FUNCTIONS')));
	}
	
	public function action_logout(){
		$this->title .= '::Редактирование';

		if($this->isGet())
		{
			// Менеджеры.
			$mUsers = M_Users::Instance();
			$mUsers->ClearSessions();
// Выход.
$mUsers->ClearSessions();
			$mUsers->Logout();

			$this->redirect('/index.php');
		}

	//	$text = text_get();
		//$this->content = $this->Template('v/v_edit.php', array('text' => $text));
	}
}

