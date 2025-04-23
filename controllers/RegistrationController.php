<?php
class RegistrationController extends Controller {
    private $pageTpl = '/views/registration.tpl.php';
    public function __construct() {
        $this->model = new RegistrationModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Регистрация';
        $this->view->render($this->pageTpl, $this->pageData);
    }
}