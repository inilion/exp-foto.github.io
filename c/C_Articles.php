<?php
//
// Конттроллер статей
//

class C_Articles extends C_Base
{
	//
	// Конструктор.
	//
	function __construct()
	{		
		parent::__construct();
	}
	
	public function action_all(){
		$this->title=$this->title.' :: Все статьи';

		$mArticles = M_Articles::Instance();
		$articles = $mArticles->articles_all();
			var_dump($articles);
		die;
		foreach($this->articles as $key => $article){
			$articles[$key]['content'] = articles_intro($article['content']);
		}
		
		$this->content = $this->Template('articles/v_articles.php', array('articles'=>$articles));
	}
}
