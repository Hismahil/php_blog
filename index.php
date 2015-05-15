<?php
//mostrar erros no navegador
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

require "config/database/mysql.php";
require "models/user.php";
require 'vendor/autoload.php';
require 'controllers/home_controller.php';
require 'controllers/users_controller.php';
require 'controllers/articles_controller.php';
require 'controllers/comments_controller.php';

define('ROOTPATH', __DIR__);
define('DOC_ROOT', preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']) );
define('BASE_URL', preg_replace("!^{".DOC_ROOT."}!", '', ROOTPATH) );
define('ASSETS', '/assets');

Mysql::connect("mysql:host=localhost;dbname=app_blog", "vagrant", "vagrant");

$app = new \Slim\Slim();

$app->get('/', '\ArticlesController:index');

$app->group('/users', function () use ($app) {
	
	$app->get('/', '\UsersController:index');
	
	$app->get('/session', function(){
		session_start();
		echo print_r($_SESSION);
	});

	$app->get('/login', '\UsersController:login');

	$app->post('/login', '\UsersController:login');

	$app->get('/signin', '\UsersController:_new');
	
	$app->get('/logout', '\UsersController:logout');

	$app->get('/:id', '\UsersController:show');

	$app->get('/:id/edit', '\UsersController:edit');
	
	$app->post('/create', '\UsersController:create');
	
	$app->put('/update/:id', function($id) use ($app){
		$user = new UsersController();
		$user->update($values = array('id' => $id,
			'user_name' => $app->request->put('user_name'), 
			'user_email' => $app->request->put('user_email'),
			'user_password' => $app->request->put('user_password'),
			'user_role_id' => $app->request->put('user_role_id')));
	});
	
	$app->get('/delete/:id', '\UsersController:destroy');

}); 

$app->group('/articles', function () use ($app) {

	$app->group('/comments', function() use ($app){

		$app->post('/create', '\CommentsController:create');

	});
	
	$app->get('/new', '\ArticlesController:_new');

	$app->post('/create', '\ArticlesController:create');

	$app->get('/:id', '\ArticlesController:show');

	$app->get('/:id/edit', '\ArticlesController:edit');
	
	$app->put('/update/:id', function($id) use ($app){
		$article = new ArticlesController();
		$article->update($values = array('id' => $id,
			'article_title' => $app->request->put('article_title'), 
			'article_content' => $app->request->put('article_content')));
	});
	
	$app->get('/delete/:id', '\ArticlesController:destroy');

});

$app->run();