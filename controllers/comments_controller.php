<?php

require_once("application_controller.php");
require_once('./models/article.php');

class CommentsController extends ApplicationController {

	public function index(){}

	public function show($id){}

	public function edit($id){}

	public function _new(){ }

	public function create(){
		$render = new MainLayout();

		if(isset($_POST['commit'])){

			$comment = new Comment(null, 
				$_POST['user_name'],
				$_POST['comment'],
				(int)$_POST['article_id'],
				null,
				null,
				null);

			$comment->save();
		}
		
		$article = Article::find((int)$_POST['article_id']);
		$alert_class = 'alert alert-success alert-dismissible';
		$alert_msg = 'Comment created with success!';
		$alert_type = 'Success';
		$render->content = include_once("./views/shareds/alert.php");
		$method = 'post';
		$action = '/articles/comments/create';
		$comment_form = include_once('./views/comments/_form.php');
		$render->addJS(ASSETS.'/js/comments.js');
		$render->content .= include_once("./views/articles/show.php");
		echo $render->getLayout(true);
	}

	public function update($id){ }

	public function destroy($id){ }
}