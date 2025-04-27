<?php

class ChangeprofileController extends Controller {
    private $pageTpl = "/views/changeprofile.tpl.php";

    public function __construct() {
        $this->model = new ChangeprofileModel();
        $this->view = new View();
    }
    public function index() {
        $this->pageData['title'] = "Редактирование профиля";
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }
    
}