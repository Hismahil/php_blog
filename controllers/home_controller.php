<?php

include_once './views/layouts/main_layout.php';

class HomeController {

	public function index() {
		$page = new MainLayout();		
		echo $page->getLayout(true);
	}
}