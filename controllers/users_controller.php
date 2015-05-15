<?php

require_once("application_controller.php");
require_once('./views/layouts/main_layout.php');
require_once('./models/user.php');

class UsersController extends ApplicationController {

	public function index(){
		$render = new MainLayout();
		
		if (session_status() == PHP_SESSION_NONE) session_start();

		if(isset($_SESSION['admin'])) {
			$users = User::all();
			$render->content = include_once("./views/users/index.php");
		}

		echo $render->getLayout(true);
	}

	public function show($id){
		$render = new MainLayout();

		if (session_status() == PHP_SESSION_NONE) session_start();

		if(isset($_SESSION['admin'])) {
			$user = User::find($id);
			$render->content = include_once("./views/users/show.php");
		}

		echo $render->getLayout(true);
	}

	public function edit($id){
		$render = new MainLayout();

		if (session_status() == PHP_SESSION_NONE) session_start();

		if(isset($_SESSION['admin'])) {
			$user = User::find($id);
			$method = 'post';
			$action = '/users/update/'.$user->id;
			$hidden = '<input type="hidden" name="_METHOD" value="PUT"/>';
			$render->content = include_once("./views/users/edit.php");
		}

		echo $render->getLayout(true);
	}

	public function _new(){
		$render = new MainLayout();
		$method = 'post';
		$action = '/users/create';
		$msg = 'Sign in';
		$render->content = include_once("./views/users/new.php");
		echo $render->getLayout(false);
	}

	public function create(){
		$render = new MainLayout();

		if(isset($_POST['commit'])){

			$user = new User(null, 
				$_POST['user_name'], 
				$_POST['user_email'], 
				md5($_POST['user_password'], false),
				true, 
				1,
				null,
				null);

			$user->save();
		}
		
		echo $render->getLayout(true);
	}

	public function update($values){
		$render = new MainLayout();
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_SESSION['admin'])) {
			$user = User::find($values['id']);

			$user->update('email', $values['user_email']);
			$user->update('password', md5($values['user_password'], false));
			$user->update('role_id', (int)$values['user_role_id']);
			$user->update('name', $values['user_name']);

			$user = User::find($values['id']);

			$render->content = include_once("./views/users/show.php");
		}

		echo $render->getLayout(true);
	}

	public function destroy($id){
		$render = new MainLayout();
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_SESSION['admin'])) {
			$user = User::find($id);

			if($user){
				$user->update('active', 0);
			}

			$users = User::all();

			$render->content = include_once("./views/users/index.php");
		}

		echo $render->getLayout(true);
	}

	public function login(){
		$render = new MainLayout();
		$set_nav = false;
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(isset($_POST['commit'])){
			$user = User::find_by('email', $_POST['user_email']);
			
			if($user->active){
				if($user && $user->auth($_POST['user_password'])) {
					if($user->role_id == 2) {
						$_SESSION['admin'] = $user->name;
						$_SESSION['user_id'] = $user->id;
					}
					else{
						$_SESSION['user_id'] = $user->id;
						$_SESSION['user_name'] = $user->name;
					}
				}
				$set_nav = true;
			}
			else
				$render->content = include_once("./views/users/login.php");
		}
		else{
			$render->content = include_once("./views/users/login.php");
		}

		echo $render->getLayout($set_nav);
	}

	public function logout(){
		$render = new MainLayout();
		if (session_status() == PHP_SESSION_NONE) session_start();

		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 

		echo $render->getLayout(true);
	}
}