<?php

class IndexController extends Controller {

	private $pageTpl = '/views/index.tpl.php';

	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}

	public function index() {
		header("Location: /login");
		//$this->pageData['title'] = "Index controller";
		//$this->view->render($this->pageTpl, $this->pageData);
	}
}