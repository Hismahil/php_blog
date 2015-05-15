<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$article = "";

if(isset($_SESSION['admin'])) {
	$user_name = $_SESSION['admin'];
	$user = "<ul class='nav navbar-nav navbar-right'>
		<li class='dropdown'>
		<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>$user_name <span class='caret'></span></a>
		<ul class='dropdown-menu' role='menu'>
		<li><a href='/users'>List Users</a></li>
		<li><a href='/users/new'>Create User</a></li>
		<li class='divider'></li>
		<li class='dropdown-header'></li>
		<li><a href='/users/logout'>Logout</a></li>
		</ul>
		</li>
		</ul>";
	$article = "<li><a href='/articles/new'>New Article</a></li>";
} elseif(isset($_SESSION['user_id'])){
	$user_name = $_SESSION['user_name'];
	$user = "<ul class='nav navbar-nav navbar-right'>
		<li class='dropdown'>
		<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>$user_name <span class='caret'></span></a>
		<ul class='dropdown-menu' role='menu'>
		<li><a href='/users/logout'>Logout</a></li>
		</ul>
		</li>
		</ul>";
	$article = "<li><a href='/articles/new'>New Article</a></li>";
} else{
	$user = "<ul class='nav navbar-nav navbar-right'>
	<li class='dropdown'>
	<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Users <span class='caret'></span></a>
	<ul class='dropdown-menu' role='menu'>
	<li><a href='/users/login'>Log in</a></li>
	<li><a href='/users/signin'>Sign in</a></li>
	</ul>
	</li>
	</ul>";
}