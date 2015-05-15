<?php

require_once("application_controller.php");
require_once('./views/layouts/main_layout.php');
require_once('./models/user.php');
require_once('./models/article.php');

class ArticlesController extends ApplicationController {

	public function index(){
		$render = new MainLayout();
		$articles = Article::all();
		$render->content = include_once("./views/articles/index.php");
		echo $render->getLayout(true);
	}

	public function show($id){
		$render = new MainLayout();
		$article = Article::find($id);
		$method = 'post';
		$action = '/articles/comments/create';
		$render->addJS(ASSETS.'/js/comments.js');
		$comment_form = include_once('./views/comments/_form.php');
		$render->content = include_once("./views/articles/show.php");
		echo $render->getLayout(true);
	}

	public function edit($id){
		$render = new MainLayout();

		if (session_status() == PHP_SESSION_NONE) session_start();

		if(isset($_SESSION['user_id'])) {
			$article = Article::find($id);
			if($article->user_id == $_SESSION['user_id']){
				$method = 'post';
				$action = '/articles/update/'.$article->id;
				$msg = 'Update Article';
				$hidden = '<input type="hidden" name="_METHOD" value="PUT"/>';
				$render->addJS(ASSETS.'/js/articles.js');
				$render->content = include_once("./views/articles/edit.php");	
			}
		}

		echo $render->getLayout(true);
	}

	public function _new(){
		$render = new MainLayout();
		$method = 'post';
		$action = '/articles/create';
		$msg = 'New Article';
		$render->addJS(ASSETS.'/js/articles.js');
		$render->content = include_once("./views/articles/new.php");
		echo $render->getLayout(true);
	}

	public function create(){
		$render = new MainLayout();

		if(session_status() == PHP_SESSION_NONE) session_start();

		if(isset($_POST['commit']) && isset($_SESSION['user_id'])){
			$user = User::find($_SESSION['user_id']);

			$article = new Article(null, 
				$_POST['article_title'],
				'Writed by '.$user->name,
				$_POST['article_content'],
				$user->id,
				null,
				null);

			$article->save();
		}
		
		$articles = Article::all();
		$alert_class = 'alert alert-success alert-dismissible';
		$alert_msg = 'Article created with success!';
		$alert_type = 'Success';
		$render->content = include_once("./views/shareds/alert.php");
		$render->content .= include_once("./views/articles/index.php");
		echo $render->getLayout(true);
	}

	public function update($values){
		$render = new MainLayout();
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_SESSION['user_id'])) {
			$article = Article::find($values['id']);

			$article->update('title', $values['article_title']);
			$article->update('content', $values['article_content']);

			$article = Article::find($values['id']);

			$render->content = include_once("./views/articles/show.php");
		}

		echo $render->getLayout(true);
	}

	public function destroy($id){
		$render = new MainLayout();
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_SESSION['user_id'])) {
			Article::destroy($id);

			$articles = Article::all();

			$render->content = include_once("./views/articles/index.php");
		}

		echo $render->getLayout(true);
	}
}