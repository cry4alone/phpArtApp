<?php
Class ProfileController extends Controller {
    private $pageTpl = '/views/profile.tpl.php';
    public function __construct() {
        $this->model = new ProfileModel();
        $this->view = new View();
    }
    
    public function index() {
        $this->pageData['title'] = 'Профиль';
        $this->view->renderLayout($this->pageTpl,$this->pageData);
    }
}