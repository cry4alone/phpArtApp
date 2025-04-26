<?php

class AboutController extends Controller {
    private $pageTpl = "/views/about.tpl.php";

    public function __construct() {
        $this->model = new AboutModel();
        $this->view = new View();
    }
    public function index() {
        $this->pageData['title'] = "О нас";
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }
    
}